<?php
// START | ADIT | 7/12/24 | FPP/MLG/2408023 - mengambil data detail customer utnuk ditampilkan di halaman rata ambil nota
namespace App\Http\Resources\salesapp;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'idcust' => trim($this->idcust) ?? '',
            'daerah' => trim($this->daerah) ?? '',
            'nama' => trim($this->nama) ?? '',
            'namatoko' => trim($this->namatoko) ?? '',
            'npwp' => trim($this->npwp) ?? '',
            'telp1' => trim($this->telp1) ?? '',
            'telp2' => trim($this->telp2) ?? '',
            'ktp_nik' => trim($this->ktp_nik) ?? '',
            'jeniscust' => trim($this->jeniscust) ?? '',
            'koordinat' => trim($this->koordinat) ?? '',
            'waktu_scanqr' => trim($this->waktu_scanqr) ?? '',
            'status' => trim($this->status) ?? '',
            'ktp_nama' => trim($this->ktp_nama) ?? '',
            'ktp_alamat' => trim($this->ktp_alamat) ?? '',
            'ktp_rt' => trim($this->ktp_rt) ?? '',
            'ktp_rw' => trim($this->ktp_rw) ?? '',
            'ktp_desa' => trim($this->ktp_desa) ?? '',
            'ktp_camat' => trim($this->ktp_camat) ?? '',
            'ktp_kabkodya' => trim($this->ktp_kabkodya) ?? '',
            'alamat' => trim($this->alamat) ?? '',
            'nopkb' => trim($this->nopkb) ?? '',
            'carabayar' => trim($this->carabayar) ?? '',
            'waktu_pkb' => trim($this->waktu_pkb) ?? '',
            'sales_pkb' => trim($this->sales_pkb) ?? '',
            'tmp_telp' => trim($this->tmp_telp) ?? '',
            'waktu_tmp_telp' => trim($this->waktu_tmp_telp) ?? '',
            'sales_tmp_telp' => trim($this->sales_tmp_telp) ?? '',
            'cabang' => trim($this->cabang) ?? '',
        ];
    }
}
//  END  | ADIT | 7/12/24 | FPP/MLG/2408023 - mengambil data detail customer utnuk ditampilkan di halaman rata ambil nota