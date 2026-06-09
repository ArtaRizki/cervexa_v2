<?php
// ADIT | START | WIG Akumulasi Diskon | 24 Oktober 2025
namespace App\model\driverapp;

use Illuminate\Database\Eloquent\Model;
use Awobaz\Compoships\Compoships;

class TrsDiskonAkumulasiHistory extends Model
{
  use Compoships;
  protected $table = 'trs_diskon_akumulasi_histori';

  protected $fillable = [
    'id_diskon',
    'nonota',
    'noso',
    'nominal_terpakai',
    'cancel_at',
    'cancel_id',
    'user_id',
  ];
}
// ADIT |  END  | WIG Akumulasi Diskon | 24 Oktober 2025
