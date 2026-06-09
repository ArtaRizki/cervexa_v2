<?php

namespace App\Http\Resources\salesv4\nota_kuning;

use Illuminate\Http\Resources\Json\JsonResource;

class KendaraanResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'nokend'    => trim($this->nokend) ?? '',
            'driver'    => trim($this->driver) ?? '',
            'sales_opr' => trim($this->sales_opr) ?? '',
            'cabang'    => trim($this->cabang) ?? '',
        ];
    }
}
