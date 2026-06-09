<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;

class TrsSalesComplaints extends Model
{
    protected $table = 'trs_sales_complaints';
    protected $fillable = [
        'tanggal',
        'sales',
        'idcust',
        'idkomplain',
        'idprod',
        'jmlpeti',
        'jmlsatu',
        'expdate',
        'kodeproduksi',
        'keluhan',
    ];
}
