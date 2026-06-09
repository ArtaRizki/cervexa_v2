<?php

namespace App\Http\Resources\v1\direksi;

use Illuminate\Http\Resources\Json\JsonResource;

class WaktuKelilingResource extends JsonResource
{

    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "id"            => $this->id,
            "mulai"         => $this->mulai,
            "selesai"       => $this->selesai,
            "daerah"        => $this->daerah,
            "idcust"        => $this->idcust,
            "cust"          => $this->cust->nama ?? "",
            "ket"           => $this->ket,
            "idkary"        => $this->idkary,
            "created_at"    => $this->created_at,
            "updated_at"    => $this->updated_at,
        ];
    }
}
