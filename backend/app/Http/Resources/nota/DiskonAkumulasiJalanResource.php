<?php
// ADIT | START | WIG Akumulasi Diskon | 20 Oktober 2025

namespace App\Http\Resources\nota;

use Illuminate\Http\Resources\Json\JsonResource;

class DiskonAkumulasiJalanResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'total_poin'        => (int) $this->total_poin,
      'nominal_transaksi' => (int) $this->nominal_transaksi,
    ];
  }
}
// ADIT |  END  | WIG Akumulasi Diskon | 20 Oktober 2025
