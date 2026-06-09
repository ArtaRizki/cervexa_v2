<?php

namespace App\Http\Resources\lokasikonsumen;

use Illuminate\Http\Resources\Json\JsonResource;

class LokasiKonsumenResource extends JsonResource
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
        $koordinat = explode(", ", $this->koordinat);
        return [
            "idcust"        => (string) $this->idcust,
            "nama"          => $this->nama,
            "daerah"        => $this->daerah,
            "jenis"         => $this->jenis,
            "koordinat"     => $this->koordinat,
            "lat"           => (double) $koordinat[0],
            "lng"           => (double) $koordinat[1],
        ];
    }
}
