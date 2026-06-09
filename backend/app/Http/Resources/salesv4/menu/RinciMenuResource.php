<?php

namespace App\Http\Resources\salesv4\menu;

use Illuminate\Http\Resources\Json\JsonResource;

class RinciMenuResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'judul'     => trim($this->judul) ?? '',
            'deskripsi' => trim($this->deskripsi) ?? '',
            'slug'      => trim($this->slug) ?? '',
            'aktif'     => $this->aktif ?? false,
        ];
    }
}
