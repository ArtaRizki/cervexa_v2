<?php

namespace App\Http\Resources\salesapp;

use Illuminate\Http\Resources\Json\JsonResource;

class BiayaOperasionalResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id'          => $this->id,
      'created_at'  => $this->created_at ?? '',
      'updated_at'  => $this->updated_at ?? '',
      'deleted_at'  => $this->deleted_at ?? '',
      'cost_name'   => $this->cost_name ?? '',
      'is_sales'    => $this->is_sales ?? '',
      'is_driver'   => $this->is_driver ?? '',
    ];
  }
}
