<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;

class TrsRiderBiayaRinci extends Model
{
    protected $table = 'trs_rider_biaya_rinci';
    protected $fillable = [
        'tanggal',
        'nokend',
        'sales',
        'idbiaya',
        'waktu',
        'jenis',
        'catatan',
        'cbayar',
        'nominal'
    ];
}
