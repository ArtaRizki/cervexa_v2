<?php

namespace App\Http\Resources\salesv4\userauth;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleskelHpResource extends JsonResource
{
  public function toArray($request)
  {
    return [
        "login" => trim($this->login),
        "initial" => trim($this->initial),
        "nama" => trim($this->nama),
        "sandi" => trim($this->sandi),
        "tingkat" => trim($this->tingkat),
        "kel" => trim($this->kel),
        "cabang" => trim($this->cabang),
        "nohp" => trim($this->nohp),
        "token" => trim($this->token),
    ];
  }
}

