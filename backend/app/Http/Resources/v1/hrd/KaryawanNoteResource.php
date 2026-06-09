<?php

namespace App\Http\Resources\v1\hrd;

use Illuminate\Http\Resources\Json\JsonResource;

class KaryawanNoteResource extends JsonResource
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
            "karyawan_id"   => $this->karyawan_id,
            "karyawan"      => $this->karyawan->pribadi->alias ?? $this->karyawan->pribadi->nama,
            "rating"        => $this->rating,
            "title"         => $this->title,
            "user_id"       => $this->user_id,
            "user"          => $this->user->pribadi->alias ?? $this->user->pribadi->nama,
            "created_at"    => $this->created_at,
        ];
    }
}
