<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      "id"                => $this->id ?? "",
      "idcust"            => $this->idcust ?? "",
      "daerah"            => $this->daerah ?? "",
      "namacust"          => $this->namacust ?? "",
      "idprod"            => $this->idprod ?? "",
      "dus"               => $this->dus ?? "",
      "pcs"               => $this->pcs ?? "",
      "keterangan"        => $this->keterangan ?? "",
      "krm_dus"           => $this->krm_dus ?? "",
      "krm_pcs"           => $this->krm_pcs ?? "",
      "bs_dus"            => $this->bs_dus ?? "",
      "bs_pcs"            => $this->bs_pcs ?? "",
      "bst_dus"           => $this->bst_dus ?? "",
      "bst_pcs"           => $this->bst_pcs ?? "",
      "nonota"            => $this->nonota ?? "",
      "jmlbayar"          => $this->jmlbayar ?? "0.0",
      "confirm_at"        => $this->confirm_at ?? "",
      "confirmbs_at"      => $this->confirmbs_at ?? "",
      "sisahutang"        => $this->sisahutang ?? "",
      "netto"             => $this->netto ?? "",
      "custbank"          => $this->custbank ?? "",
      "custbank2"         => $this->custbank2 ?? "",
      "carabayar"         => $this->carabayar ?? "",
      "carabayar2"        => $this->carabayar2 ?? "",
      "status"            => $this->status ?? "",
      "bayar_tunai"       => $this->bayar_tunai ?? "",
      "bayar_bank"        => $this->bayar_bank ?? "",
      "bayar_trf"         => $this->bayar_trf ?? "",
      "bayar"             => $this->bayar ?? "",
      "bataljual_at"      => $this->bataljual_at ?? "",
      "bataljual_alasan"  => $this->bataljual_alasan ?? "",
      "cabang_kan"        => $this->cabang_kan ?? "",
      "cabang_to"         => $this->cabang_to ?? "",

    ];
  }
}
