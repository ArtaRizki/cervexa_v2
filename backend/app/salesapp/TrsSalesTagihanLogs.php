<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;

class TrsSalesTagihanLogs extends Model
{
    protected $table = 'trs_sales_tagihan_logs';
    protected $fillable = [
        'tanggal',
        'idcust',
        'nobayar',
        'nonota',
        'sales',
        'jmlcetak',
        'keterangan',
    ];
}
