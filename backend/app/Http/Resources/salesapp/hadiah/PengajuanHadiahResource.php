<?php

namespace App\Http\Resources\salesapp\hadiah;

use Illuminate\Http\Resources\Json\JsonResource;

class PengajuanHadiahResource extends JsonResource
{
    public function toArray($request)
    {

      return [
        'id'            => $this->id ?? 0,
        'tanggal'       => trim($this->tanggal) ?? '',
        'idcust'        => trim($this->idcust) ?? '',
        'daerah'        => $this->customer == null ? '' : trim($this->customer->daerah),
        'customer'      => $this->customer == null ? '' : trim($this->customer->nama),
        'nik'           => trim($this->ktp_nik) ?? '',
        'npwp'          => trim($this->npwp) ?? '',
        'id'            => $this->id ?? 0,
        'produk'        => $this->hadiah == null ? '' : trim($this->hadiah->nama),
        'custom'        => trim($this->giftcustom) ?? '',
        'qty'           => $this->qty ?? 0,
        'poin'          => $this->hadiah == null ? 0 : ($this->hadiah->poin * $this->qty ?? 0),
        // 'photo'         => trim($this->photo) ?? '',
        'photo'         => url('storage/img/penjualan/pengajuangift_dev/' . $this->photo),
        'tracking'      => $this->tracking,
        'imgReceive'    => $this->serah == null ? [] : $this->serah->img,
      ];
    }
}
