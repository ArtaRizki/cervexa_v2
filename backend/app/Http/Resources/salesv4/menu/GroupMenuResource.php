<?php

namespace App\Http\Resources\salesv4\menu;

use App\Http\Resources\salesv4\menu\RinciMenuResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupMenuResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'nama'  => trim($this->nama) ?? '',
            'aktif' => $this->aktif ?? false,
        ];
    }
}
