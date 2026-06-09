<?php

namespace App\Http\Resources\salesapp;

use Illuminate\Http\Resources\Json\JsonResource;

class LaporanNotaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'cabang'        => trim($this->cabang) ?? '',
            'tgl'           => trim($this->tgl) ?? '',
            'cnokend'       => trim($this->cnokend) ?? '',
            'trans'         => $this->trans ?? 0,
            'tagihan'       => $this->tagihan ?? 0,
            'diskon'        => $this->diskon ?? 0,
            'iddaerah'      => trim($this->iddaerah) ?? '',
            'namadriver'    => trim($this->namadriver) ?? '',
            'namasales'     => trim($this->namasales) ?? '',
            'jual'          => $this->jual ?? 0,
            'retur'         => $this->retur ?? 0,
            'kredit'        => $this->kredit ?? 0,
            'tunai'         => $this->tunai ?? 0,
            'biaya'         => $this->biaya ?? 0,
            'transfer'      => $this->transfer ?? 0,
            'edc'           => $this->edc ?? 0,
            'pot_piutang'   => $this->pot_piutang ?? 0,
            'terimakas'     => $this->terimakas ?? 0,
            'sales'         => $this->sales ?? 0,
            'selisih'       => $this->selisih ?? 0,
            'nokend'        => trim($this->nokend) ?? '',
            'alias'         => trim($this->alias) ?? '',
            'status'        => trim($this->status) ?? '',
            'totpoin'       => $this->totpoin ?? 0,
            'jurnal'        => $this->jurnal,
        ];
    }
}
