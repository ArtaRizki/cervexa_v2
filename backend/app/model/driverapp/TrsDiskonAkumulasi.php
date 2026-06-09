<?php
// ADIT | START | WIG Akumulasi Diskon | 20 Oktober 2025
namespace App\model\driverapp;

use Illuminate\Database\Eloquent\Model;
use Awobaz\Compoships\Compoships;

class TrsDiskonAkumulasi extends Model
{
  use Compoships;
  protected $table = 'trs_diskon_akumulasi';

  protected $fillable = [
    'idcust',
    'periode',
    'total_poin',
    'nominal_transaksi',
    'diskon',
    'nominal_diskon',
  ];

  public function history() {
    return $this->hasMany(TrsDiskonAkumulasiHistory::class, 'id_diskon', 'id')
      ->select('id_diskon')
      ->selectRaw('SUM(nominal_terpakai) as diskon_terpakai')
      // ->where('noso', '<>', null)
      ->where('cancel_at', null)
      ->where('cancel_id', null)
      ->groupBy('id_diskon');
  }
}
// ADIT |  END  | WIG Akumulasi Diskon | 20 Oktober 2025
