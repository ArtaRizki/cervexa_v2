<?php

namespace App\Http\Resources\salesapp;

use Illuminate\Http\Resources\Json\JsonResource;

class LaporanBSResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'tanggal'       => $this->tanggal,
            'nokend'        => trim($this->nokend) ?? '',
            'daerah'        => trim($this->daerah) ?? '',
            'customer'      => trim($this->customer) ?? '',
            'produk'        => trim($this->produk) ?? '',
            'jenis'         => trim($this->jenis) ?? '',
            'ket'           => trim($this->ket) ?? '',
            'isipeti'       => $this->isipeti ?? 0,
            'dus'           => $this->dus ?? 0,
            'pcs'           => $this->pcs ?? 0,
            'kodeproduksi'  => trim($this->kodeproduksi) ?? '',
            'expdate'       => $this->expdate,
            'driver'        => trim($this->driver) ?? '',
            'sales'         => trim($this->sales) ?? '',
            'cabang'        => trim($this->cabang) ?? '',
            'created_at'    => $this->created_at,
        ];
    }
}
