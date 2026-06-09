<?php

namespace App\Http\Resources\salesapp\sinkron;

use Illuminate\Http\Resources\Json\JsonResource;

class NokendResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'nokend'    => trim($this->nokend) ?? '',
            'driver'    => trim($this->driver) ?? '',
            'cabang'    => trim($this->cabang) ?? '',
        ];
    }
}
