<?php

namespace App\Http\Resources\v1\ppic;

use Illuminate\Http\Resources\Json\JsonResource;

class PermintaanResource extends JsonResource
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
            "user"                  => $this->user->pribadi->nama,
            "bagian"                => $this->user->bagian,

            //Model
            "img"                   => $this->img,
            "tracking"              => $this->tracking,
            "isPending"             => $this->isPending,
            "isUrgent"              => $this->isUrgent,
            "isRejected"            => $this->isRejected,
            "id_permintaan"         => $this->id_permintaan,
            "tglminta"              => $this->tglminta,
            "jenisbrg"              => $this->jenisbrg ?? "",
            "nama"                  => $this->nama ?? "",
            "qty"                   => $this->qty ?? "",
            "satuan"                => $this->satuan ?? "",
            "jenispr"               => $this->jenispr ?? "",
            "status"                => $this->status ?? "",
            "id_karyawan"           => $this->id_karyawan ?? "",
            "spesifik"              => $this->spesifik ?? "",
            "keperluan"             => $this->keperluan ?? "",
            "id_barang"             => $this->id_barang ?? "",
            "no_minta"              => $this->no_minta ?? "",
            "ket"                   => $this->ket ?? "",
            "klasifikasi"           => $this->klasifikasi ?? "",
            "merk"                  => $this->merk ?? "",
            "created_at"            => $this->created_at,
            "updated_at"            => $this->updated_at,
            "user_id"               => $this->user_id,
            "submited_at"           => $this->submited_at,
            "approved_at"           => $this->approved_at,
            "approved_user_id"      => $this->approved_user_id,
            "rejected_at"           => $this->rejected_at,
            "rejected_note"         => $this->rejected_note,
            "rejected_user_id"      => $this->rejected_user_id,
        ];
    }
}
