<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;

class TrsRiderBiaya extends Model
{
    protected $table = 'trs_rider_biaya';
    protected $fillable = [
        'tanggal',
        'nokend',
        'sales',
        'idbiaya',
        'waktu',
        'total',
        'kunci_at'
    ];
}
