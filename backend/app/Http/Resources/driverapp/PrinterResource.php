<?php

namespace App\Http\Resources\driverapp;

use App\Http\Resources\v1\hrd\KaryawanResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PrinterResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'id'        => $this->id,
      'type'      => trim($this->type ?? ""),
      'size'      => trim($this->size ?? ""),
      'align'     => trim($this->align ?? ""),
      // 'createdAt' => $this->created_at ?? "",
      // 'updatedAt' => $this->updated_at ?? "",
      // 'user'      => new KaryawanResource(auth()->user()),
    ];
  }
}
