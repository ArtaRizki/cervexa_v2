<?php

namespace App\Http\Resources\salesapp\sinkron;

use Illuminate\Http\Resources\Json\JsonResource;

class KendaraanResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'nokend'    => trim($this->nokend) ?? '',
            'alias'     => trim($this->alias) ?? '',
            'bbm'       => trim($this->bahanbakar->jenis) ?? '',
            'harga'     => trim($this->bahanbakar->harga) ?? '',
            'cabang'    => trim($this->cabang) ?? '',
        ];
    }
}
