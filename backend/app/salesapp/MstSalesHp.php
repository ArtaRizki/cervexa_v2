<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;

class MstSalesHp extends Model
{
    protected $table = 'mst_sales_hp';
    protected $fillable = [
        'nohp',
        'namasales',
        'tampilsetting',
        'kel',
        'token',
    ];

    public $timestamps = false;
}
