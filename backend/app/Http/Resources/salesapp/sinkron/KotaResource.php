<?php

namespace App\Http\Resources\salesapp\sinkron;

use Illuminate\Http\Resources\Json\JsonResource;

class KotaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'kdkota'    => trim($this->kdkota) ?? '',
            'kota'      => trim($this->cabang) ?? '',
        ];
    }
}
