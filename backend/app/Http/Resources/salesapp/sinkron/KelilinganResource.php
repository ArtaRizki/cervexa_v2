<?php

namespace App\Http\Resources\salesapp\sinkron;

use Illuminate\Http\Resources\Json\JsonResource;

class KelilinganResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'login'     => trim($this->login) ?? '',
            'initial'   => trim($this->initial) ?? '',
            'nama'      => trim($this->nama) ?? '',
            'sandi'     => trim($this->sandi) ?? '',
            'tingkat'   => trim($this->tingkat) ?? '',
            'kel'       => trim($this->kel) ?? '',
            'cabang'    => trim($this->cabang) ?? '',
            'nohp'      => trim($this->nohp) ?? '',
        ];
    }
}
