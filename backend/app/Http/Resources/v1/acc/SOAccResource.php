<?php

namespace App\Http\Resources\v1\acc;

use App\v1\acc\StockOpnameAcc;
use Illuminate\Http\Resources\Json\JsonResource;

class SOAccResource extends JsonResource
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
        $produk = $this->produk;
        $sisapcs = $this->pcs % $produk->isipeti;
        $ball = $this->ball + (($this->pcs - $sisapcs) / $produk->isipeti);
        $rinci = StockOpnameAcc::where(['tanggal' => $this->tanggal, 'idprod' => $this->idprod])->get();
        return [
            'tanggal'   => $this->tanggal,
            'produk'    => trim($produk->nama),
            'idprod'    => $this->idprod,
            'ball'      => $ball,
            'pcs'       => $sisapcs,
            'rinci'     => $rinci,
        ];
    }
}
