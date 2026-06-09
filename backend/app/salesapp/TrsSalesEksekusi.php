<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;

class TrsSalesEksekusi extends Model
{
    protected $table = 'trs_sales_eksekusi';
    protected $fillable = [
        'ideksekusi',
        'perintah',
        'cek',
        'hasil',
        'sales',
    ];
}
