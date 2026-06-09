<?php

namespace App\Http\Resources\driverapp;

use Illuminate\Http\Resources\Json\JsonResource;

class DriverResource extends JsonResource
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
      "nama"          => $this->pribadi->nama,
      "alias"         => $this->pribadi->alias,
      "pekerjaan"     => $this->pekerjaan ?? "",
      "cabang_nama"   => $this->cabangNama ?? "",
    ];
  }
}
