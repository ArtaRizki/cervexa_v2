<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrsSalesDriverNotes extends Model
{
    protected $table = 'trs_sales_driver_notes';
    protected $fillable = [
        'tanggal',
        'nokend',
        'idcust',
        'nonota',
        'isinote',
    ];
}
