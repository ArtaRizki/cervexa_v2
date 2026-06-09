<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;

class TrsSalesRekapPhotos extends Model
{
    protected $table = 'trs_sales_rekap_photos';
    protected $fillable = [
        'tanggal',
        'nokend',
        'nota',
        'photo',
    ];
}
