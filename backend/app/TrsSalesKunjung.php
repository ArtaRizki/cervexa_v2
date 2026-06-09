<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrsSalesKunjung extends Model
{
    protected $table = 'trs_sales_kunjung';

    protected $fillable = [
        'tanggal',
        'idcust',
        'ambil_ya',
        'ambil_tidak',
        'cabang',
        'user_id',
        'nokend',
        'src',
    ];
}
