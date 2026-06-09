<?php
// ADIT | START | WIG Akumulasi Diskon | 21 Oktober 2025
namespace App\model\driverapp;

use Illuminate\Database\Eloquent\Model;
use Awobaz\Compoships\Compoships;
use Carbon\Carbon;

class MstDiskonAkumulasi extends Model
{
  use Compoships;
  protected $table = 'mst_diskon_akumulasi';

  public function scopeMasukPeriode($query) {
    $hariIni = Carbon::now();

    return $query->whereDate('mulai', '<=', $hariIni)
      ->whereDate('akhir', '>=', $hariIni);
  }

  public function scopeRangePoin($query, $poin) {
    return $query->where('dasar_awal', '<=', $poin)
      ->where('dasar_akhir', '>=', $poin);
  }
}
// ADIT |  END  | WIG Akumulasi Diskon | 21 Oktober 2025
