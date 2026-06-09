# Review ConfirmCheckController.php

File yang direview: `V:\app\Http\Controllers\salesapp\ConfirmCheckController.php`

## Ringkasan

`ConfirmCheckController` dibuat sebagai API pengganti JDBC untuk pengecekan data sebelum masuk ke `PembayaranActivity` / `fabBiayakanvas`. Controller ini mengambil data dari:

- `tmp_sales_rinci`
- `trs_sales_rinci`
- `trs_sales_nota`
- `trs_sales_kunjung`

Tujuan utamanya adalah mengembalikan data lengkap beserta jumlah baris agar bisa dibandingkan dengan data lokal SQLite di APK.

## Temuan Kritikal

### 1. Filter scope tidak konsisten antar tabel

Lokasi:

- `tmp_sales_rinci`: sekitar baris 44
- `trs_sales_rinci`: sekitar baris 95
- `trs_sales_nota`: sekitar baris 148
- `trs_sales_kunjung`: sekitar baris 198

Masalah:

- `tmp_sales_rinci` dan `trs_sales_rinci` difilter memakai `tanggal` dan `initial nonota`, tetapi tidak memakai `sales` atau `nokend`.
- `trs_sales_nota` difilter memakai `sales` dan `tanggal`, tetapi tidak memakai `nokend` atau `initial`.
- `trs_sales_kunjung` difilter memakai `nokend` dan `tanggal`, tetapi tidak memakai `sales`.

Dampak:

Data yang dikembalikan dari server bisa tidak berada dalam scope yang sama dengan data lokal APK. Akibatnya proses compare bisa false mismatch, misalnya:

- data sales lain ikut masuk,
- data kendaraan lain ikut masuk,
- data nota yang tidak relevan ikut dibandingkan,
- atau data yang seharusnya dibandingkan tidak ikut terbaca.

Rekomendasi:

Samakan scope filter di semua query. Jika APK membandingkan data untuk satu `tanggal + sales + nokend`, maka semua query sebaiknya memakai scope tersebut, ditambah filter `initial` jika memang dibutuhkan untuk detail nota.

Contoh:

```php
$tanggal = Carbon\Carbon::createFromFormat('Y-m-d', $request->tanggal)->startOfDay();
$nextDay = $tanggal->copy()->addDay();

$sales   = trim($request->sales);
$nokend  = trim($request->nokend);
$initial = trim($request->initial);
```

Kemudian pakai scope serupa:

```php
->where('tanggal', '>=', $tanggal)
->where('tanggal', '<', $nextDay)
->where('sales', $sales)
->where('nokend', $nokend)
```

Catatan: sebelum menambahkan filter `sales` dan `nokend` ke `tmp_sales_rinci` / `trs_sales_rinci`, pastikan kolom tersebut memang ada dan nilainya konsisten di tabel tersebut.

## Temuan Penting

### 2. Filter `<>` terhadap kolom nullable bisa membuang data valid

Lokasi:

- `trs_sales_rinci`, sekitar baris 103:

```php
->where('keterangan', '<>', 'cancel')
```

Masalah:

Jika `keterangan` bernilai `NULL`, SQL Server tidak akan menganggap `NULL <> 'cancel'` sebagai true. Akibatnya row dengan `keterangan = NULL` tidak ikut terambil, padahal kemungkinan itu data valid.

Perbaikan:

```php
->whereRaw("ISNULL(keterangan, '') <> 'cancel'")
```

Untuk filter batal pada `trs_sales_nota`, pola yang sama juga lebih aman:

```php
->whereRaw("SUBSTRING(ISNULL(catatan, ''), 1, 12) <> '<!--Batal-->'")
```

### 3. Filter tanggal rawan salah jika kolom bertipe datetime

Lokasi:

- `tmp_sales_rinci`, sekitar baris 46
- `trs_sales_rinci`, sekitar baris 97
- `trs_sales_nota`, sekitar baris 151
- `trs_sales_kunjung`, sekitar baris 201

Kode saat ini:

```php
->where('tanggal', $tanggal)
```

Masalah:

Jika kolom `tanggal` bertipe `datetime` dan menyimpan jam, filter tersebut hanya cocok untuk data tepat di `YYYY-MM-DD 00:00:00`. Data pada jam lain tidak akan ikut.

Perbaikan:

```php
->where('tanggal', '>=', $tanggal)
->where('tanggal', '<', $nextDay)
```

### 4. Response error membocorkan detail internal

Lokasi:

- sekitar baris 238-243

Kode saat ini:

```php
return response()->json([
  'error'   => 'Gagal mengambil data dari server',
  'message' => $e->getMessage(),
], 500);
```

Masalah:

`$e->getMessage()` bisa berisi detail SQL, nama tabel, nama kolom, atau informasi koneksi. Ini tidak ideal untuk dikirim ke APK.

Perbaikan:

```php
} catch (\Throwable $e) {
  Log::error('ConfirmCheckController@index failed', [
    'tanggal' => $request->tanggal,
    'sales'   => $request->sales,
    'nokend'  => $request->nokend,
    'initial' => $request->initial,
    'error'   => $e->getMessage(),
  ]);

  return response()->json([
    'error' => 'Gagal mengambil data dari server',
  ], 500);
}
```

### 5. Query bisa berat karena memakai fungsi di filter

Lokasi:

- `SUBSTRING(nonota, ...)`
- `RTRIM(idprod)`
- `SUBSTRING(catatan, ...)`

Masalah:

Filter seperti ini membuat index lebih sulit dimanfaatkan oleh SQL Server, terutama jika tabel besar.

Contoh:

```php
->whereRaw("SUBSTRING(nonota, 1, 3) = ?", [$initial])
->whereRaw("RTRIM(idprod) <> '-'")
```

Rekomendasi:

- Pastikan filter yang indexed seperti `tanggal`, `sales`, dan `nokend` dipakai seketat mungkin sebelum filter berbasis fungsi.
- Jika memungkinkan, gunakan kolom normalisasi untuk prefix nota agar tidak perlu `SUBSTRING()`.
- Jika tetap harus memakai `SUBSTRING()`, pastikan jumlah data yang sudah terseleksi oleh filter lain sudah kecil.

### 6. Validasi request masih terlalu longgar

Lokasi:

- sekitar baris 30-35

Kode saat ini:

```php
$this->validate($request, [
  'tanggal' => 'required|date_format:Y-m-d',
  'sales'   => 'required',
  'nokend'  => 'required',
  'initial' => 'required',
]);
```

Masalah:

Input `sales`, `nokend`, dan `initial` belum dibatasi format dan panjangnya. Untuk endpoint compare data, input sebaiknya dibuat eksplisit.

Contoh perbaikan:

```php
$this->validate($request, [
  'tanggal' => 'required|date_format:Y-m-d',
  'sales'   => 'required|string|max:50',
  'nokend'  => 'required|string|max:30',
  'initial' => 'required|string|min:3|max:3',
]);
```

Jika tersedia tabel master:

```php
'sales'  => 'required|exists:dev.mst_user,nama',
'nokend' => 'required|exists:dev.mst_kendaraan,nokend',
```

## Contoh Refactor Bagian Kritis

Contoh berikut belum mengganti seluruh `selectRaw`, tetapi menunjukkan pola filter dan error handling yang lebih aman.

```php
use Carbon\Carbon;

public function index(Request $request)
{
  $this->validate($request, [
    'tanggal' => 'required|date_format:Y-m-d',
    'sales'   => 'required|string|max:50',
    'nokend'  => 'required|string|max:30',
    'initial' => 'required|string|min:3|max:3',
  ]);

  $tanggal = Carbon::createFromFormat('Y-m-d', $request->tanggal)->startOfDay();
  $nextDay = $tanggal->copy()->addDay();

  $sales   = trim($request->sales);
  $nokend  = trim($request->nokend);
  $initial = trim($request->initial);

  try {
    $trsRinciData = DB::connection('dev')
      ->table('trs_sales_rinci')
      ->where('tanggal', '>=', $tanggal)
      ->where('tanggal', '<', $nextDay)
      ->where(function ($q) use ($initial) {
        $q->whereRaw("SUBSTRING(nonota, 1, 3) = ?", [$initial])
          ->orWhereRaw("SUBSTRING(nonota, 2, 3) = ?", [$initial]);
      })
      ->whereRaw("SUBSTRING(nonota, 1, 1) <> 'M'")
      ->whereRaw("ISNULL(keterangan, '') <> 'cancel'")
      ->whereRaw("RTRIM(idprod) <> '-'")
      ->get();

    $trsNotaData = DB::connection('dev')
      ->table('trs_sales_nota')
      ->where('tanggal', '>=', $tanggal)
      ->where('tanggal', '<', $nextDay)
      ->where('sales', $sales)
      ->where('nokend', $nokend)
      ->whereRaw("SUBSTRING(ISNULL(catatan, ''), 1, 12) <> '<!--Batal-->'")
      ->whereRaw("SUBSTRING(nonota, 1, 1) <> 'M'")
      ->get();

    $trsKunjungData = DB::connection('dev')
      ->table('trs_sales_kunjung')
      ->where('tanggal', '>=', $tanggal)
      ->where('tanggal', '<', $nextDay)
      ->where('nokend', $nokend)
      ->where('src', 'nota')
      ->get();

    return response()->json([
      'trs_rinci' => [
        'count' => $trsRinciData->count(),
        'data'  => $trsRinciData,
      ],
      'trs_nota' => [
        'count' => $trsNotaData->count(),
        'data'  => $trsNotaData,
      ],
      'trs_kunjung' => [
        'count' => $trsKunjungData->count(),
        'data'  => $trsKunjungData,
      ],
    ]);
  } catch (\Throwable $e) {
    Log::error('ConfirmCheckController@index failed', [
      'tanggal' => $request->tanggal,
      'sales'   => $request->sales,
      'nokend'  => $request->nokend,
      'initial' => $request->initial,
      'error'   => $e->getMessage(),
    ]);

    return response()->json([
      'error' => 'Gagal mengambil data dari server',
    ], 500);
  }
}
```

## Prioritas Perbaikan

1. Samakan scope filter semua query berdasarkan definisi compare APK.
2. Perbaiki filter nullable untuk `keterangan` dan `catatan`.
3. Ganti filter tanggal equality menjadi range harian jika kolom bertipe datetime.
4. Jangan kirim detail exception ke APK.
5. Perketat validasi input.
6. Evaluasi performa query `SUBSTRING()` dan `RTRIM()` jika data sudah besar.

## Catatan Akhir

Controller ini sudah cukup jelas dari sisi tujuan, tetapi bagian paling rawan adalah konsistensi scope data. Karena endpoint ini dipakai untuk compare data lokal vs server, sedikit perbedaan filter antar tabel bisa langsung menghasilkan mismatch yang sulit dilacak di APK.
