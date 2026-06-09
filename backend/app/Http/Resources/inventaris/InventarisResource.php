<?php

namespace App\Http\Resources\inventaris;

use Illuminate\Http\Resources\Json\JsonResource;

class InventarisResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "id"            => (string) $this->id,
            "golongan"      => $this->golongan,
            "kategori"      => $this->kategori,
            "jenis"         => $this->jenis,
            "nama"          => $this->nama,
            "noseri"        => $this->noseri,
            "lokasi"        => $this->lokasi,
            "divisi"        => $this->divisi,
            "pemakai"       => $this->pemakai,
            "status"        => $this->status,
            "keterangan"    => $this->keterangan,
            "qrcek"         => $this->qrcek,
            "opname"        => $this->opname,
            "user_id"       => $this->user_id,
        ];
    }
}
