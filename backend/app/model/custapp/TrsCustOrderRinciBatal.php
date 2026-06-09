<?php

namespace App\model\custapp;

use Illuminate\Database\Eloquent\Model;

class TrsCustOrderRinciBatal extends Model
{
    protected $table = 'trs_cust_order_rinci_batal';
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
