<?php

namespace App\Http\Resources\driverapp;

use Illuminate\Http\Resources\Json\JsonResource;

class HPAktifResource extends JsonResource
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
            "id"            => $this->id,
            "androidId"     => $this->androidId,
            "alias"         => $this->alias,
            "brand"         => $this->brand,
            "type"          => $this->type,
            "driver"        => $this->driver->pribadi->nama,
            "karyawan_id"   => $this->karyawan_id,
            "user"          => $this->user->pribadi->nama,
            "user_id"       => $this->user_id,
            "tanggal"       => $this->driver->pribadi->karyv1->drvrekap->tanggal ?? "",
            "nokend"        => $this->driver->pribadi->karyv1->drvrekap->kendaraan->nokend ?? "",
            "kendaraan"     => trim($this->driver->pribadi->karyv1->drvrekap->kendaraan->alias ?? ""),
        ];
    }
}
