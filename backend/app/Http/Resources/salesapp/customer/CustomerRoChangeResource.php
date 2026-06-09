<?php

namespace App\Http\Resources\salesapp\customer;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerRoChangeResource extends JsonResource
{
  public function toArray($request)
  {
    $jenis = (int) $this->jenis;
    $jenis_text = $jenis === 1 ? 'RO > Non RO' : ($jenis === 2 ? 'NOO > RO' : 'Non RO > RO');

    return [
      'idcust' => trim($this->idcust),
      'nama' => trim($this->customer->nama),
      'cabang' => trim($this->cabang),
      'daerah' => trim($this->daerah),
      'jenis' => $jenis,
      'jenis_text' => $jenis_text,
      'exec_date' => $this->exec_date,
      'is_exec' => (int) $this->is_exec,
      'display_start' => $this->display_start,
      'display_end' => $this->display_end,
      'cutoff_date' => $this->cutoff_date,
    ];
  }
}
