<?php

namespace App\Http\Resources\salesv4\menu;

use App\Http\Resources\KaryawanAllDataResource;
use App\Http\Resources\salesv4\menu\GroupMenuResource;
use App\Http\Resources\salesv4\menu\RinciMenuResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AksesMenuResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'group'          => $this->group, //new GroupMenuResource($this->group),
            'rinci'         => RinciMenuResource::collection($this->rinci),
        ];
    }
}
