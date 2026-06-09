<?php

namespace App\Http\Resources\salesv4\master;

use Illuminate\Http\Resources\Json\JsonResource;

class BankJualResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'=> trim($this->id) ?? '',
            'nama'=> trim($this->nama) ?? '',
            'jenis'=> trim($this->jenis) ?? '',
            'norek'=> trim($this->norek) ?? '',
            'status'=> trim($this->status) ?? '',
            'cabang'=> trim($this->cabang) ?? '',
        ];
    }
}
