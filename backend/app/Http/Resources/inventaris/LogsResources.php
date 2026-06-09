<?php

namespace App\Http\Resources\inventaris;

use Illuminate\Http\Resources\Json\JsonResource;

class LogsResources extends JsonResource
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
            "id"            => (String) $this->id,
            "inventaris_id" => $this->inventaris_id,
            "keterangan"    => $this->keterangan,
            "user_id"       => $this->user_id,
            "created_by"    => $this->user->username,
            "created_at"    => $this->created_at->format('d M Y H:i:s'),
        ];
    }
}
