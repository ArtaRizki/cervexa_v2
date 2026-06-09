<?php

namespace App\model\custapp;

use Illuminate\Database\Eloquent\Model;

class TrsCustOrder extends Model
{
    protected $table = 'trs_cust_order';
    protected $fillable = [
        'tanggal',
        'idcust',
        'nonota',
        'jumlah',
        'diskon',
        'netto',
        'poin',
        'jmlbayar',
        'sisahutang',
        'sysdate',
        'cabang',
        'carabayar',
        'prsdisklain',
        'banknorek',
        'bayar_tunai',
        'bayar_bank',
        'bayar_trf',
    ];
}
