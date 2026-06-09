<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;

class TrsSalesCompetitors extends Model
{
    protected $table = 'trs_sales_competitors';
    protected $fillable = [
        'idkompetitor',
        'tanggal',
        'kel',
        'sales',
        'idcust',
        'daerah',
        'customer',
        'produsen',
        'kotaprod',
        'produk',
        'jenis',
        'kemasan',
        'berat',
        'ukuran',
        'expdate',
        'isidus',
        'hargabeli',
        'hbper',
        'hargajual',
        'hjper',
        'bpom',
        'halal',
        'keterangan',
        'sales_cetak_at',
        'dibeli_at',
        'cabang',
    ];
}
