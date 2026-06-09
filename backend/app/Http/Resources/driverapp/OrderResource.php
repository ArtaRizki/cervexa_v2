<?php
// ADIT | START | WIG Akumulasi Diskon | 29 Oktober 2025

namespace App\Http\Resources\driverapp;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'idcust'            => trim($this->idcust),
      "daerah"            => trim($this->daerah),
      "namacust"          => trim($this->namacust),
      "idprod"            => trim($this->idprod),
      "dus"               => $this->dus,
      "pcs"               => $this->pcs,
      "keterangan"        => $this->keterangan,
      "krm_dus"           => $this->krm_dus,
      "krm_pcs"           => $this->krm_pcs,
      "bs_dus"            => $this->bs_dus,
      "bs_pcs"            => $this->bs_pcs,
      "bst_dus"           => $this->bst_dus,
      "bst_pcs"           => $this->bst_pcs,
      "nonota"            => $this->nonota,
      "jmlbayar"          => $this->jmlbayar,
      "netto"             => $this->netto,
      "diskon_order"      => (int) $this->diskon_order ?? 0,
      "jumlah_order"      => (int) $this->jumlah_order ?? 0,
      "poin_order"        => (float) ($this->poin_order ?? 0),
      "poin"              => (float) ($this->poin ?? 0),
      "confirm_at"        => $this->confirm_at,
      "confirmbs_at"      => $this->confirmbs_at,
      "sisahutang"        => $this->sisahutang,
      "custbank"          => trim($this->custbank),
      "custbank2"         => trim($this->custbank2),
      "carabayar"         => trim($this->carabayar),
      "carabayar2"        => trim($this->carabayar2),
      "status"            => trim($this->status),
      "bayar_tunai"       => $this->bayar_tunai,
      "bayar_bank"        => $this->bayar_bank,
      "bayar_trf"         => $this->bayar_trf,
      "bayar"             => $this->bayar,
      "bataljual_at"      => $this->bataljual_at,
      "bataljual_alasan"  => $this->bataljual_alasan,
      "cabang_kan"        => trim($this->cabang_kan),
      "cabang_to"         => trim($this->cabang_to),
      "jenis_order"       => $this->jenis_order,
    ];
  }
}
// ADIT |  END  | WIG Akumulasi Diskon | 29 Oktober 2025
