<?php

namespace App\model\driverapp;

use Illuminate\Database\Eloquent\Model;
use App\driverapp\TrsDrvRinci;
use Awobaz\Compoships\Compoships;

class TrsSalesRinci extends Model
{
    use Compoships;

    protected $table = 'trs_sales_rinci';

    // ADIT | START | WIG Akumulasi Diskon | 20 Oktober 2025
    protected $fillable = [
      'tanggal',
      'nokend',
      'nonota',
      'idcust',
      'idprod',
      'jualpeti',
      'jualsatu',
      'satuan',
      'jumlah',
      'diskon',
      'poinbrg',
      'poin',
      'poinplus',
      'cabang',
      'sample',
      'poin_promo',
      'opr',
      'user_id',
    ];
    // ADIT |  END  | WIG Akumulasi Diskon | 20 Oktober 2025

    protected $guarded = [];
    public function nota()
    {
        return $this->belongsTo(TrsSalesNota::class, 'nonota', 'nonota');
    }
    public function barangturun()
    {
        return $this->hasOne(TrsDrvRinci::class, ['tanggal', 'nokend', 'idprod', 'idcust'], ['tanggal', 'nokend', 'idprod', 'idcust']);
    }
}
