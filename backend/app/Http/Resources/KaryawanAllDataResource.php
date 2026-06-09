<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KaryawanAllDataResource extends JsonResource
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
            'id'            => $this->id,
            'nip'           => $this->nip,
            'nfp'           => $this->nfp,
            'username'      => $this->username,

            'join_date'     => $this->join_date,
            'begin_date'    => $this->begin_date,
            'end_date'      => $this->end_date,
            'resign_date'   => $this->resign_date,
            'resign_note'   => $this->resign_note,

            'status_id'     => $this->status_id,
            'jabatan_id'    => $this->jabatan_id,
            'bagian_id'     => $this->bagian_id,
            'pekerjaan_id'  => $this->pekerjaan_id,
            'lokasi_id'     => $this->lokasi_id,

            'status'        => $this->status->status ?? '',
            'jabatan'       => $this->jabatan->jabatan ?? '',
            'bagian'        => $this->bagian->bagian ?? '',
            'pekerjaan'     => $this->pekerjaan->pekerjaan ?? '',
            'lokasi'        => $this->lokasi->lokasi ?? '',

            'lokasi_konsumen_admin' => $this->lokasi_konsumen_admin ?? '',

            //pribadi
            'pribadi'       => new KaryawanPribadiResource($this->pribadi),
            // 'nama'              => $this->pribadi->nama,
            // 'alias'             => $this->pribadi->alias,
            // 'email'             => $this->pribadi->email,
            // 'phone'             => $this->pribadi->phone,
            // 'gender'            => $this->pribadi->gender,
            // 'agama'             => $this->pribadi->agama,
            // 'darah'             => $this->pribadi->darah,

            // 'lahir_date'        => $this->pribadi->lahir_date,
            // 'lahir_kota'        => $this->pribadi->lahir_kota,

            // 'rtrw'            => $this->pribadi->rtrw,
            // 'alamat'            => $this->pribadi->alamat,
            // 'kelurahan'         => $this->pribadi->kelurahan,
            // 'kecamatan'         => $this->pribadi->kecamatan,
            // 'kota'              => $this->pribadi->kota,
            // 'provinsi'          => $this->pribadi->provinsi,

            // 'tt_rtrw'         => $this->pribadi->tt_rtrw,
            // 'tt_alamat'         => $this->pribadi->tt_alamat,
            // 'tt_kelurahan'      => $this->pribadi->tt_kelurahan,
            // 'tt_kecamatan'      => $this->pribadi->tt_kecamatan,
            // 'tt_kota'           => $this->pribadi->tt_kota,
            // 'tt_provinsi'       => $this->pribadi->tt_provinsi,

            // 'status_nikah'      => $this->pribadi->status_nikah,
            // 'tanggungan'        => $this->pribadi->tanggungan,

            // 'nik'               => $this->pribadi->nik,
            // 'kk'                => $this->pribadi->kk,
            // 'bpjs'              => $this->pribadi->bpjs,
            // 'bpjstk'            => $this->pribadi->bpjstk,
            // 'npwp'              => $this->pribadi->npwp,

            // 'emergency_phone'   => $this->pribadi->emergency_phone,
            // 'emergency_name'    => $this->pribadi->emergency_name,



            // 'absensi'    => $this->absensi,



        ];
    }
}
