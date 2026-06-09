<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;

class TrsSalesTagihan extends Model
{
    protected $table = 'trs_sales_tagihan';
    protected $fillable = [
        'tglbayar',
        'nobayar',
        'nokend',
        'tglnota',
        'nonota',
        'idcust',
        'jmlbayar',
        'cabang',
        'idcustcab',
        'bayar_tunai',
        'bayar_bank',
        'banknorek',
        'nobuktibayar',
        'custbank',
        'bayar_trf',
        // START | ADIT | 18/12/24 | FPP/MLG/2411011 - input bayar qris
        'bayar_qris',
        'user_id',
        //  END  | ADIT | 18/12/24 | FPP/MLG/2411011 - input bayar qris
        'bayar_piutang',
    ];

    public $timestamps = false;
}
