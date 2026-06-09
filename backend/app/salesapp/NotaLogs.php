<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;

class NotaLogs extends Model
{
    protected $table = 'trs_sales_nota_logs';
    protected $fillable = [
        'tanggal',
        'nokend',
        'idcust',
        'nonota',
        'jmlcetak',
        'keterangan',
        'sales',
    ];
}
