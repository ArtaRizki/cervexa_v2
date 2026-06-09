<?php

namespace App;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class MstBBM extends Model
{
  protected $table = 'mst_bbm';

  public function scopeMaxMulai($query)
  {
    // ARTA | START | FPP/MLG/2510004 - Variabel Environment | 08 Oktober 2025
    // $maxTgl = MstBBM::on('dev')->whereDate('tanggal', '<=', Carbon::now()->toDateString())
    $maxTgl = MstBBM::on('sqlsrv')->whereDate('tanggal', '<=', Carbon::now()->toDateString())
      // ARTA | END | FPP/MLG/2510004 - Variabel Environment | 08 Oktober 2025
      ->latest('tanggal')
      ->pluck('tanggal')
      ->first();

    return $query->whereDate('tanggal', $maxTgl);
  }
}
