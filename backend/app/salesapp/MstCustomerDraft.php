<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;

class MstCustomerDraft extends Model
{
    protected $table = 'mst_customer_draft';
    protected $fillable = [
        'idcust',
        'daerah',
        'nama',
        'namatoko',
        'npwp',
        'telp1',
        'telp2',
        'ktp_nik',
        'jeniscust',
        'koordinat',
        'waktu_scanqr',
        'status',
        'ktp_nama',
        'ktp_alamat',
        'ktp_rt',
        'ktp_rw',
        'ktp_desa',
        'ktp_camat',
        'ktp_kabkodya',
        'alamat',
        'nopkb',
        'carabayar',
        'waktu_pkb',
        'sales_pkb',
        'tmp_telp',
        'waktu_tmp_telp',
        'sales_tmp_telp',
        'cabang',
    ];
    public function daerah()
    {
        return $this->hasMany(MstDaerah::class, 'daerah', 'daerah');
    }
}
