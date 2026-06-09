<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MstDaerah extends Model
{
  protected $table = 'mst_daerah';

  public function scopeMaxTgl($query)
  {
    // ARTA | START | FPP/MLG/2510004 - Variabel Environment | 08 Oktober 2025
    // $maxTgl = MstDaerah::on('dev')->whereDate('mulai', '<=', Carbon::now()->toDateString())
    $maxTgl = MstDaerah::on('sqlsrv')->whereDate('mulai', '<=', Carbon::now()->toDateString())
      // ARTA | END | FPP/MLG/2510004 - Variabel Environment | 08 Oktober 2025
      ->latest('mulai')
      ->pluck('mulai')
      ->first();

    return $query->whereDate('mulai', $maxTgl);
  }
}
