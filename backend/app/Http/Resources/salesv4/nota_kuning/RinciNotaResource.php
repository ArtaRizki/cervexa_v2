<?php

namespace App\Http\Resources\salesv4\nota_kuning;

use Illuminate\Http\Resources\Json\JsonResource;

class RinciNotaResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'nonota' => trim($this->nonota) ?? '',
      'tanggal' => trim($this->tanggal) ?? '',
      'idprod' => trim($this->idprod) ?? '',
      'jualpeti' => !empty($this->jualpeti) ? (int) $this->jualpeti : 0,
      'jualsatu' => !empty($this->jualsatu) ? (int) $this->jualsatu : 0,
      'turunpeti' => !empty($this->turunpeti) ? (int) $this->turunpeti : 0,
      'turunsatu' => !empty($this->turunsatu) ? (int) $this->turunsatu : 0,
      'bspeti' => !empty($this->bspeti) ? (int) $this->bspeti : 0,
      'bssatu' => !empty($this->bssatu) ? (int) $this->bssatu : 0,
      'satuan' => !empty($this->satuan) ? (int) $this->satuan : 0,
      'jumlah' => !empty($this->jumlah) ? (int) $this->jumlah : 0,
      'poin' => !empty($this->poin) ? (int) $this->poin : 0,
      'tgl_create' => trim($this->tgl_create) ?? '',
      'tanggal' => trim($this->tanggal) ?? '',
      'tgl_print' => trim($this->tgl_print) ?? '',
      'keterangan' => trim($this->keterangan) ?? '',
      'status_barang' => trim($this->status_barang) ?? '',
      'confirm_at' => trim($this->confirm_at) ?? '',
      'confirmbs_at' => trim($this->confirmbs_at) ?? '',
    ];
  }
}
