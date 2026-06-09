<?php
// ADIT | START | WIG Akumulasi Diskon | 20 Oktober 2025

namespace App\Http\Resources\nota;

use Illuminate\Http\Resources\Json\JsonResource;

class DiskonAkumulasiLaluResource extends JsonResource
{
  public function toArray($request)
  {
    $nominal_diskon = (int) $this->nominal_diskon;

    if ($this->history->count() > 0) {
      $diskon_terpakai = (int) $this->history->first()->diskon_terpakai;
    } else {
      $diskon_terpakai = 0;
    }

    $sisa_diskon = $nominal_diskon - $diskon_terpakai;

    return [
      'total_poin'          => (int) $this->total_poin,
      'nominal_transaksi'   => (int) $this->nominal_transaksi,
      'persen_diskon'       => (int) $this->diskon,
      'nominal_diskon'      => (int) $nominal_diskon,
      'nominal_sisa_diskon' => (int) $sisa_diskon,
    ];
  }
}
// ADIT |  END  | WIG Akumulasi Diskon | 20 Oktober 202
