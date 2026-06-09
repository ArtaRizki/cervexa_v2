<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;

class TrsRiderBiayaPhotos extends Model
{
    protected $table = 'trs_rider_biaya_photos';
    protected $fillable = [
        'tanggal',
        'nokend',
        'idbiaya',
        'photo',
    ];
}
