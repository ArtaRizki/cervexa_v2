<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KaryawanPribadiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // $pasfoto = array_map(function ($res) {
        //     return array(
        //         'link' => url('storage/img/hrd/karyawan/' . basename($res)),
        //     );
        // }, File::glob(storage_path('app/public/img/hrd/karyawan/' . $this->id . '_pasfoto_*.*')));
        // $dokumen = array_map(function ($res) {
        //     $tmp = pathinfo($res);
        //     return array(
        //         'link' => url('storage/img/hrd/karyawan/dokumen/' . $this->id . '/' .  $tmp['basename']),
        //         'filename' => $tmp['filename'],
        //         'extension' => $tmp['extension'],
        //     );
        // }, File::glob(storage_path('app/public/img/hrd/karyawan/dokumen/' . $this->id . '/*.*')));
        // $pasfoto = array_reverse($pasfoto);
        return [
            'id'                => $this->id,
            'karyawan_id'       => $this->karyawan_id,
            'pekerjaan_id'      => $this->pekerjaan_id,
            'pekerjaan'         => $this->pekerjaan->pekerjaan ?? '',

            'nama'              => $this->nama,
            'alias'             => $this->alias,
            'email'             => $this->email,
            'phone'             => $this->phone,
            'gender'            => $this->gender,
            'agama'             => $this->agama,
            'darah'             => $this->darah,

            'lahir_date'        => $this->lahir_date,
            'lahir_kota'        => $this->lahir_kota,

            'rtrw'              => $this->rtrw,
            'alamat'            => $this->alamat,
            'kelurahan'         => $this->kelurahan,
            'kecamatan'         => $this->kecamatan,
            'kota'              => $this->kota,
            'provinsi'          => $this->provinsi,

            'tt_rtrw'           => $this->tt_rtrw,
            'tt_alamat'         => $this->tt_alamat,
            'tt_kelurahan'      => $this->tt_kelurahan,
            'tt_kecamatan'      => $this->tt_kecamatan,
            'tt_kota'           => $this->tt_kota,
            'tt_provinsi'       => $this->tt_provinsi,

            'status_nikah'      => $this->status_nikah,
            'tanggungan'        => $this->tanggungan,

            'nik'               => $this->nik,
            'kk'                => $this->kk,
            'bpjs'              => $this->bpjs,
            'bpjstk'            => $this->bpjstk,
            'npwp'              => $this->npwp,

            'sim'               => $this->sim,
            'sim_number'        => $this->sim_number,
            'sim_date'          => $this->sim_date,

            'bank'              => $this->bank,
            'bank_number'       => $this->bank_number,

            'emergency_phone'   => $this->emergency_phone,
            'emergency_name'    => $this->emergency_name,

            'user_id'           => $this->user_id,

            'pendidikan'        => $this->pendidikan,
            'keluarga'          => $this->keluarga,
            // 'pengalaman'        => KaryawanPengalamanResource::collection($this->pengalaman),
            // 'pasfoto'           => $pasfoto ?? "",
            // 'dokumen'           => $dokumen ?? "",
        ];
    }
}
