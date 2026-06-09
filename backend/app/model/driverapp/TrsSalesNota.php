<?php

namespace App\model\driverapp;

use App\MstCustomer;
use App\TrsSalesRinci;
use App\VUser;
use Illuminate\Database\Eloquent\Model;
use Awobaz\Compoships\Compoships;
use Carbon\Carbon;

class TrsSalesNota extends Model
{
    use Compoships;
    protected $table = 'trs_sales_nota';

    // ADIT | START | WIG Akumulasi Diskon | 20 Oktober 2025
    protected $fillable = [
      'tanggal',
      'nokend',
      'idcust',
      'nonota',
      'jumlah',
      'diskon',
      'netto',
      'poin',
      'jmlbayar',
      'sisahutang',
      'lebihbayar',
      'retur',
      'recehan',
      'ppn',
      'ppndisk',
      'tgl_create',
      'tempppn',
      'opr',
      'iddaerah',
      'cabang',
      'carabayar',
      'prsdisklain',
      'nobuktibayar',
      'banknorek',
      'bayar_tunai',
      'bayar_bank',
      'custbank',
      'bayar_trf',
      'noso',
      'waktu_awal',
      'sysdate',
      'user_id',
      'driver_note',
    ];
    // ADIT |  END  | WIG Akumulasi Diskon | 20 Oktober 2025

    protected $guarded = [];

    public function rinci()
    {
        return $this->hasMany(TrsSalesRinci::class, 'nonota', 'nonota');
    }

    public function cust()
    {
        return $this->hasOne(MstCustomer::class, 'idcust', 'idcust');
    }

    public function user()
    {
        return $this->hasOne(VUser::class, 'id', 'user_id');
    }

    public function diskonAkumulasiHistori() {
      return $this->hasOne(TrsDiskonAkumulasiHistory::class, 'nonota', 'nonota');
    }
    // ADIT |  END  | WIG Akumulasi Diskon | 20 Oktober 2025
}
