<?php

namespace App\Http\Resources\salesapp;

use Illuminate\Http\Resources\Json\JsonResource;
use App\salesapp\TrsDiskonAkumulasiHistori;
use App\model\driverapp\TrsSalesNota;
use App\model\salesapp\MstCustomer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AkumulasiDiskonPoinResource extends JsonResource
{
  public function toArray($request)
  {
    // =========================================================================
    // 0. PERSIAPAN TANGGAL (Parsing Input)
    // =========================================================================
    $rawTanggal = $request->input('tanggal');

    // Default: Gunakan waktu sekarang jika tidak ada input
    $carbonDate = Carbon::now();

    if (!empty($rawTanggal)) {
      try {
        $carbonDate = Carbon::parse($rawTanggal);
      } catch (\Exception $e) {
        $carbonDate = Carbon::now();
      }
    }

    // Format untuk Query SQL
    $tanggalQuery = $carbonDate->format('Y-m-d H:i:s');


    // =========================================================================
    // 1. DATA UMUM (Sisa Diskon dll - Tidak terpengaruh tanggal berjalan)
    // =========================================================================

    $totalTerpakai = TrsDiskonAkumulasiHistori::where('id_diskon', $this->id)
      ->whereNull('cancel_at')
      ->sum('nominal_terpakai');

    $sisa = max(0, ((float) $this->nominal_diskon ?? 0.0) - (float) $totalTerpakai);

    $namaCustomer = DB::table('mst_customer')
      ->where('idcust', $this->idcust)
      ->value('nama');

    $namaCustomer = trim($namaCustomer ?? 'Customer Not Found');

    $redeemPoin = (float) (DB::table('v_poin_cust')
      ->where('idcust', $this->idcust)
      ->pluck('sisa')
      ->first() ?? 0);


    // =========================================================================
    // 2. CEK STATUS & TENTUKAN RANGE TANGGAL VALID
    // =========================================================================

    // Cari Mst Diskon yang melingkupi tanggal input
    $periodeDiskon = DB::table('mst_diskon')
      ->where('mulai', '<=', $tanggalQuery)
      ->where('akhir', '>=', $tanggalQuery)
      ->orderBy('id', 'desc')
      ->first();

    $isActive = ($periodeDiskon && $periodeDiskon->is_doublepoin == 1) ? "1" : "0";

    // --- LOGIKA UTAMA PERUBAHAN ---
    // Tentukan Start Date & End Date untuk Query Transaksi

    // 1. Batas Awal Default: Awal Bulan
    $startFilter = $carbonDate->copy()->startOfMonth()->startOfDay();

    // 2. Batas Akhir Default: Tanggal Input (Saat ini)
    $endFilter   = $carbonDate->copy();

    // 3. JIKA ADA DISKON AKTIF, PERSEMPIT RANGE (IRISAN)
    // Agar transaksi yang dihitung benar-benar sesuai range diskon
    if ($periodeDiskon) {
      $diskonMulai = Carbon::parse($periodeDiskon->mulai);
      $diskonAkhir = Carbon::parse($periodeDiskon->akhir);

      // Jika Diskon mulai SETELAH awal bulan, geser startFilter maju
      // Contoh: Awal bulan tgl 1, Diskon mulai tgl 5. Maka hitung mulai tgl 5.
      if ($diskonMulai->gt($startFilter)) {
        $startFilter = $diskonMulai;
      }

      // (Opsional) Jika Diskon berakhir SEBELUM tanggal input (jarang terjadi karena query di atas), geser endFilter mundur
      if ($diskonAkhir->lt($endFilter)) {
        $endFilter = $diskonAkhir;
      }
    }
    // -----------------------------


    // =========================================================================
    // 3. QUERY TRANSAKSI BERJALAN (MENGGUNAKAN $startFilter & $endFilter)
    // =========================================================================

    $totalPoinJalan = 0;
    $nominalAkumulasiJalan = 0;
    $totalPoinPrediksi = 0;
    $totalNominalPrediksi = 0;
    $nominalTerpakaiBerjalan = 0;

    $detailSOBerjalan = [
      'total_nominal_terpakai' => 0.0,
      'so_terakhir_noso' => null,
      'so_terakhir_nominal' => 0.0,
    ];

    try {
      // A. Nominal Terpakai (Histori) - Cek created_at sesuai range valid
      $nominalTerpakaiBerjalan = (float) TrsDiskonAkumulasiHistori::where('id_diskon', $this->id)
        ->whereBetween('created_at', [$startFilter, $endFilter])
        ->whereNull('cancel_at')
        ->sum('nominal_terpakai');

      $detailSOBerjalan['total_nominal_terpakai'] = $nominalTerpakaiBerjalan;

      // B. Detail SO Terakhir
      $soTerakhir = TrsDiskonAkumulasiHistori::where('id_diskon', $this->id)
        ->whereBetween('created_at', [$startFilter, $endFilter])
        ->whereNull('cancel_at')
        ->whereNotNull('noso')
        ->where('noso', '!=', '')
        ->orderBy('created_at', 'desc')
        ->first(['noso', 'nominal_terpakai']);

      if ($soTerakhir) {
        $detailSOBerjalan['so_terakhir_noso'] = $soTerakhir->noso;
        $detailSOBerjalan['so_terakhir_nominal'] = (float) $soTerakhir->nominal_terpakai;
      }

      // C. Poin & Nominal Nota (Trs Sales Nota) - Cek waktu_awal sesuai range valid
      $notaPoinJalanData = DB::table('trs_sales_rinci AS r')
        ->join('trs_sales_nota AS n', 'n.nonota', '=', 'r.nonota')
        ->where('n.idcust', $this->idcust)
        ->whereBetween('n.waktu_awal', [$startFilter, $endFilter]) // <--- PAKAI FILTER BARU
        ->where(function ($q) {
          $q->whereNull('n.catatan')
            ->orWhere('n.catatan', 'NOT LIKE', '%<!--Batal-->%');
        })
        ->selectRaw('COALESCE(SUM(r.poin), 0) AS total_poin')
        ->first();

      $tmpUntukNota = DB::table('trs_sales_nota AS n')
        ->join('tmp_sales_order AS m', 'm.nojual', '=', 'n.nonota')
        // ->join('tmp_sales_order AS m', 'm.nojual', '=', 'n.nonota')
        ->where('m.idcust', $this->idcust)
        ->whereBetween('m.sysdate', [$startFilter, $endFilter]) // <-- Filter Baru
        ->where(function ($q) {
          $q->whereNull('m.catatan')
            ->orWhere('m.catatan', 'NOT LIKE', '%<!--Batal-->%');
        })
        ->selectRaw('
            COALESCE(SUM(n.poin), 0) AS total_poin,
            COALESCE(SUM(n.jumlah), 0) AS total_nominal
        ')
        ->first();

      $totalPoinJalanTmp = (int) ($tmpUntukNota->total_poin ?? 0);
      $totalNominalJalanTmp = (int) ($tmpUntukNota->total_nominal ?? 0);
      $totalPoinJalan = (int) ($notaPoinJalanData->total_poin ?? 0);
      // $totalPoinJalan = (int) ($notaPoinJalanData->total_poin ?? 0) + $totalPoinJalanTmp;


      $notaNominalData = TrsSalesNota::where('idcust', $this->idcust)
        ->whereBetween('waktu_awal', [$startFilter, $endFilter])
        ->where(function ($q) {
          $q->whereNull('catatan')
            ->orWhere('catatan', 'NOT LIKE', '%<!--Batal-->%');
        })
        ->selectRaw('COALESCE(SUM(jumlah), 0) AS total_nominal')
        ->first();


      $nominalAkumulasiJalan = (float) ($notaNominalData->total_nominal ?? 0);
      // $nominalAkumulasiJalan = (float) ($notaNominalData->total_nominal ?? 0) + $totalNominalJalanTmp;

      // D. Prediksi (TMP Sales Order) - Cek sysdate sesuai range valid
      $prediksiTmp = DB::table('tmp_sales_order_rinci as r')
        ->join('tmp_sales_order as n', 'n.nonota', '=', 'r.nonota')
        ->where('n.idcust', $this->idcust)
        // ->where(function ($query) {
        //   $query->whereNull('n.nojual')->orWhere('n.nojual', '');
        // })
        ->where(function ($query) {
          $query->whereNull('n.bataljual_at')->orWhere('n.bataljual_at', '');
        })
        ->where(function ($q) {
          $q->whereNull('n.catatan')
            ->orWhere('n.catatan', 'NOT LIKE', '%<!--Batal-->%');
        })
        // sysdate di tmp_sales_order harus masuk dalam range diskon yg aktif
        ->whereBetween('n.sysdate', [$startFilter, $endFilter]) // <--- PAKAI FILTER BARU
        ->selectRaw('
            COALESCE(SUM(r.poin), 0) AS tmp_poin,
            COALESCE(SUM(r.jumlah), 0) AS tmp_nominal
          ')
        ->first();

      // E. Prediksi (Nota Non-SO) - Cek waktu_awal sesuai range valid
      $prediksiNota = DB::table('trs_sales_nota AS n')
        ->leftJoin('trs_sales_rinci AS r', 'n.nonota', '=', 'r.nonota')
        ->where('n.idcust', $this->idcust)
        ->where(function ($q) {
          $q->whereNull('n.noso')->orWhere('n.noso', '');
        })
        ->where(function ($q) {
          $q->whereNull('n.catatan')
            ->orWhere('n.catatan', 'NOT LIKE', '%<!--Batal-->%');
        })
        ->whereBetween('n.waktu_awal', [$startFilter, $endFilter]) // <--- PAKAI FILTER BARU
        ->selectRaw('
            COALESCE(SUM(r.poin), 0) AS rinci_poin,
            COALESCE(SUM(r.jumlah), 0) AS nota_nominal
          ')
        ->first();

      $totalPoinPrediksi =
        (float) ($prediksiTmp->tmp_poin ?? 0) +
        (float) ($prediksiNota->rinci_poin ?? 0);

      $totalNominalPrediksi =
        (float) ($prediksiTmp->tmp_nominal ?? 0) +
        (float) ($prediksiNota->nota_nominal ?? 0);
    } catch (\Exception $e) {
      // Quiet fail
    }

    return [
      'id' => $this->id,
      'idcust' => $this->idcust,
      'nama_cust' => $namaCustomer,
      'periode' => $this->periode,
      'total_poin' => (int) $this->total_poin,
      'nominal_transaksi' => (float) $this->nominal_transaksi,
      'diskon' => (int) $this->diskon,
      'nominal_diskon' => (float) $this->nominal_diskon,
      'total_terpakai' => (float) $totalTerpakai,
      'sisa' => (float) $sisa,
      'detail_nominal_terpakai_so_berjalan' => $detailSOBerjalan,
      'total_poin_jalan' => (int) $totalPoinJalan,
      'akumulasi_transaksi_jalan' => (float) $nominalAkumulasiJalan,
      'total_poin_prediksi' => (float) $totalPoinPrediksi,
      'total_nominal_prediksi' => (float) $totalNominalPrediksi,
      'redeem_poin' => $redeemPoin,
      'is_active' => $isActive,
      // Debug info (opsional - boleh dihapus)
      'debug_range' => [
        'start' => $startFilter->toDateTimeString(),
        'end' => $endFilter->toDateTimeString()
      ],
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
    ];
  }
}
