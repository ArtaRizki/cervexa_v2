<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;

class TmpSalesSinkronPromo extends Model
{
    protected $table = 'tmp_sales_sinkron_promo';
    protected $fillable = [
        'tgl',
        'sales',
        'waktu_sinkron_promo',
    ];
    public $timestamps = false;
}
