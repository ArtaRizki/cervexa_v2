<?php

namespace App\Http\Resources\salesv4\master;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'idcust'  => trim($this->idcust) ?? '',
            'nama'    => trim($this->nama) ?? '',
            'telp1'   => trim($this->telp1) ?? '',
            'telp2'   => trim($this->telp2) ?? '',
            'npwp'    => trim($this->npwp) ?? '',
            'ktp_nik' => trim($this->ktp_nik) ?? '',
        ];
    }
}
