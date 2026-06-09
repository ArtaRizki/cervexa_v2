<?php

namespace App\Http\Resources\salesapp;

use Illuminate\Http\Resources\Json\JsonResource;

class AkumulasiDiskonPoinHistoriResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'id_diskon' => $this->id_diskon,
      'nonota' => $this->nonota,
      'noso' => $this->noso,
      'nominal_terpakai' => (float) $this->nominal_terpakai,
      'cancel_at' => $this->cancel_at,
      'cancel_id' => $this->cancel_id,
      'user_id' => $this->user_id,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      // Opsi: Muat detail Diskon Induk (hanya jika relasi sudah di-load dengan ->with('diskonAkumulasi'))
      'diskon_akumulasi' => new AkumulasiDiskonPoinResource($this->whenLoaded('diskonAkumulasi')),
    ];
  }
}
