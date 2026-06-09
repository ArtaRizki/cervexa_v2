<?php

namespace App\Http\Resources\salesv4\nota_kuning;

use Illuminate\Http\Resources\Json\JsonResource;

class RekapNotaResource extends JsonResource
{
  public function toArray($request)
  {
    // Membersihkan value dari kolom catatan yang menyimpan catatan Batal Nota
    $inputString = trim($this->catatan);
    // Gunakan regex untuk mencocokkan pattern di dalam <!-- -->
    preg_match_all('/<!--(.*?)-->/', $inputString, $matches);
    // Jika hasil preg_match_all mengandung dua elemen
    $isBatal = false;
    $alasanBatal = '';
    if (isset($matches[1][0])) {
        // Bagian pertama adalah informasi batal ("Batal" atau lainnya)
        $isBatal = trim($matches[1][0]) === 'Batal';
    }
    if (isset($matches[1][1])) {
        // Bagian kedua adalah alasan batal jika ada
        $alasanBatal = trim($matches[1][1]);
    }

    return [
      'tanggal'=> trim($this->tanggal) ?? '',
      'nonota'=> trim($this->nonota) ?? '',
      'idcust'=> trim($this->idcust) ?? '',
      'jumlah'=> trim($this->jumlah) ?? '',
      'jumlah_bayar'=> trim($this->jmlbayar) ?? '',
      'poin'=> trim($this->poin) ?? '',
      'namacust'=> trim($this->customer->nama) ?? '',
      'daerahcust'=> trim($this->customer->daerah) ?? '',
      'netto'=> trim($this->netto) ?? '',
      'diskon'=> trim($this->diskon) ?? '',
      'diskonlain'=> trim($this->diskonlain) ?? '',
      'is_batal'=> $isBatal,
      'alasan_batal'=> $alasanBatal,
      'waktu_awal'=> trim($this->waktu_awal) ?? '',
      'waktu_akhir'=> trim($this->waktu_akhir) ?? '',
      'lokasi'=> trim($this->lokasi) ?? '',
      'nokend'=> trim($this->nokend) ?? '',
      'jml_cetak'=> trim($this->jml_cetak) ?? '',
      'noso'=> trim($this->noso) ?? '',
      'prsdisklain'=> trim($this->prsdisklain) ?? '',
      // pembayaran keduapertama
      'carabayar'=> trim($this->carabayar) ?? '',
      'custbank'=> trim($this->custbank) ?? '',
      'nobuktibayar'=> trim($this->nobuktibayar) ?? '',
      'bayar_bank'=> trim($this->bayar_bank) ?? '',
      'bayar_trf'=> trim($this->bayar_trf) ?? '',
      'bayar_tunai'=> trim($this->bayar_tunai) ?? '',
      'banknorek'=> trim($this->banknorek) ?? '',
      // pembayaran kedua
      'carabayar2'=> trim($this->carabayar2) ?? '',
      'custbank2'=> trim($this->custbank2) ?? '',
      'nobuktibayar2'=> trim($this->nobuktibayar2) ?? '',
      'bayar_bank2'=> trim($this->bayar_bank2) ?? '',
      'bayar_trf2'=> trim($this->bayar_trf2) ?? '',
      'bayar_tunai2'=> trim($this->bayar_tunai2) ?? '',
      'banknorek2'=> trim($this->banknorek2) ?? '',
      'notes_sales'=> trim($this->notes_sales) ?? '',
      'sales'=> trim($this->sales) ?? '',
      'tgl_print'=> trim($this->tgl_print) ?? '',
      'is_trs_sync'=> $this->is_trs_sync ?? '0',
    ];
  }
}
