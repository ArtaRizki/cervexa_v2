<?php

namespace App\Http\Resources\driverapp;

use Illuminate\Http\Resources\Json\JsonResource;

class KendStandyResource extends JsonResource
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
            "nokend"            => $this->nokend,
            "alias"             => $this->alias,
            "onduty"            => $this->onduty ?? false,
        ];
    }
}
