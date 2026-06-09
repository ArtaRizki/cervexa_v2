<?php

namespace App\Http\Resources\salesv4\master;

use Illuminate\Http\Resources\Json\JsonResource;

class BankResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'=> trim($this->id) ?? '',
            'nama'=> trim($this->nama) ?? '',
        ];
    }
}
