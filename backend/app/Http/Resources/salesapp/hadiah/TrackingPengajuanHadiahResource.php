<?php

namespace App\Http\Resources\salesapp\hadiah;

use Illuminate\Http\Resources\Json\JsonResource;

class TrackingPengajuanHadiahResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request)
    {
        return [
            'tracking'      => $this->tracking,
        ];
    }
}
