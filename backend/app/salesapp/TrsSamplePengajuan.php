<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;

class TrsSamplePengajuan extends Model
{
    protected $table = 'trs_sample_pengajuan';
    public $timestamps = false;
    protected $fillable = [
        'bagian',
        'id_kary',
        'jenis',
        'tanggal',
        'idcust',
        'daerah',
        'instansi',
        'keperluan',
        'status',
        'sysdate',
        'idprod',
        'dus',
        'pcs',
    ];
}
