<?php

namespace App\Http\Resources\v1\hrd;

use Illuminate\Http\Resources\Json\JsonResource;

class KaryawanResource extends JsonResource
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
        return [
            "id"            => $this->id,
            "pribadi_id"    => $this->pribadi_id,
            "nip"           => $this->nip,
            "nfp"           => $this->nfp,
            "join_date"     => $this->join_date,
            "begin_date"    => $this->begin_date,
            "end_date"      => $this->end_date,
            "resign_date"   => $this->resign_date,
            "resign_note"   => $this->resign_note,
            "status_id"     => $this->status_id,
            "jabatan_id"    => $this->jabatan_id,
            "bagian_id"     => $this->bagian_id,
            "pekerjaan_id"  => $this->pekerjaan_id,
            "lokasi_id"     => $this->lokasi_id,
            "username"      => $this->username,
            "user_id"       => $this->user_id,
            "id_karyawan"   => $this->id_karyawan,
            "idkary"        => $this->idkary,

            "status"        => $this->status->status ?? "",
            "lokasi"        => $this->lokasi->lokasi ?? "",
            "jabatan"       => $this->jabatan->jabatan ?? "",
            "bagian"        => $this->bagian->bagian ?? "",
            "pekerjaan"     => $this->pekerjaan->pekerjaan ?? "",

            "pribadi"       => new KaryawanPribadiResource($this->pribadi),
            "notes"         => KaryawanNoteResource::collection($this->mynotes),
        ];
    }
}
