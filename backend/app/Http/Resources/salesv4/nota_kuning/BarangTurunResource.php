<?php

namespace App\Http\Resources\salesv4\nota_kuning;

use Illuminate\Http\Resources\Json\JsonResource;

class BarangTurunResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      "tanggal" => trim($this->tanggal),
      "idcust" => trim($this->idcust) ?? '',
      "daerah" => trim($this->daerah) ?? '',
      "nama" => trim($this->nama) ?? '',
      "idprod" => trim($this->idprod) ?? '',
      "kodeproduksi" => trim($this->kodeproduksi) ?? '',
      "expdate" => trim($this->expdate),
      "dus" => !empty($this->dus) ? (int) $this->dus : 0,
      "pcs" => !empty($this->pcs) ? (int) $this->pcs : 0,
      "nonota" => trim($this->nonota) ?? '',
      "ket" => $this->ket ?? '',
      "keluhan" => $this->keluhan ?? '',
      "nourut" => (int) $this->nourut,
      "scan_at" => $this->scan_at ?? date("Y-m-d H:i:s"),
    ];
  }
}
