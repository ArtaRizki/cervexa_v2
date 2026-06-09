<?php

namespace App\Http\Resources\salesv4\master;

use Illuminate\Http\Resources\Json\JsonResource;

class DaerahResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'iddaerah'=> trim($this->iddaerah) ?? '',
            'daerah'=> trim($this->daerah) ?? '',
            'cabang'=> trim($this->cabang) ?? '',
        ];
    }
}
