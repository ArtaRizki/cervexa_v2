<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrsGudang extends Model
{
    protected $table = 'trs_gudang';
    protected $fillable =[
        'idprod',
        'kodeprod',
        'expdate',
        'tanggal',
        'tgl_isi',
        'nokend',
        'qtypeti',
        'qtysatu',
        'ket',
        'nobukti',
        'jenis',
        'user_id',
        'petugas',
    ];
}
