<?php

namespace App\Http\Resources\salesv4\master;

use Illuminate\Http\Resources\Json\JsonResource;

class ProdukResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "idprod" => trim($this->idprod),
            "isipeti" => !empty($this->isipeti) ? (int) $this->isipeti : 0,
            "isiperball" => !empty($this->isiperball) ? (int) $this->isiperball : 0,
            "harga" => !empty($this->harga) ? (int) $this->harga : 0,
            "poin" => !empty($this->poin) ? (int) $this->poin : 0,
            "poinmulai" => trim($this->poinmulai),
            "poinrentang" => !empty($this->poinrentang) ? (int) $this->poinrentang : 0,
            "poinpromo" => !empty($this->poinpromo) ? (int) $this->poinpromo : 0,
            "poinberlaku" => !empty($this->poinberlaku) ? (int) $this->poinberlaku : 0,
            "hargalama" => !empty($this->hargalama) ? (int) $this->hargalama : 0,
            "hargamulai" => trim($this->hargamulai),
            "hargaper" => trim($this->hargaper),
            "hargapromo" => !empty($this->hargapromo) ? (int) $this->hargapromo : 0,
            "hargafree" => !empty($this->hargafree) ? (int) $this->hargafree : 0,
            "hargafreeper" => trim($this->hargafreeper),
            "tonage" => !empty($this->tonage) ? $this->tonage :'0.0',
            "acc_hargamulai" => trim($this->acc_hargamulai),
        ];
    }
}
