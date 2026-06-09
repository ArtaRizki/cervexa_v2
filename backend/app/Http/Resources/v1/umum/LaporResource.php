<?php

namespace App\Http\Resources\v1\umum;

use Illuminate\Http\Resources\Json\JsonResource;

class LaporResource extends JsonResource
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
            "id" => $this->id,
            "title" => $this->title,
            "desc" => $this->desc,
            "location" => $this->location,
            "res_at" => $this->res_at,
            "res_note" => $this->res_note,
            "res_user_id" => $this->res_user_id,
            "res_user" => $this->res->pribadi->alias ?? $this->res->pribadi->nama ?? "",

            "user_id" => $this->user_id,
            "user" => $this->user->pribadi->alias ?? $this->user->pribadi->nama,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "deleted_at" => $this->deleted_at,
            "lat" => $this->lat,
            "long" => $this->long,
            "kategori" => $this->kategori,
            "img" => $this->img,
            "isNeedResponse" => $this->isNeedResponse,
        ];
    }
}
