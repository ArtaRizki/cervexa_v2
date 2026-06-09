<?php

namespace App\model\custapp;

use Illuminate\Database\Eloquent\Model;

class TrsCustOrderRinci extends Model
{
    protected $table = 'trs_cust_order_rinci';
    protected $fillable = [
        'tanggal',
        'nonota',
        'idcust',
        'idprod',
        'jualpeti',
        'jualsatu',
        'bspeti',
        'bssatu',
        'satuan',
        'jumlah',
        'diskon',
        'poinbrg',
        'poin',
        'poinplus',
        'cabang',
        'poin_promo',
    ];
}
