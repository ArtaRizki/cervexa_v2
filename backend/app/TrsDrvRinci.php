<?php

namespace App;

use App\Mstbahan;
use Illuminate\Database\Eloquent\Model;
use Awobaz\Compoships\Compoships;

class TrsDrvRinci extends Model
{
  use Compoships;

  protected $table = 'trs_drv_rinci';
  protected $fillable = [
    'tanggal',
    'nonota',
    'cabang',
    'opr',
    'nokend',
    'idcust',
    'idprod',
    'jualpeti',
    'jualsatu',
    'bspeti',
    'bssatu',
    'bstpeti',
    'bstsatu',
    'bssebab',
    'bssebabket',
    'catatan',
    'deleted_at',
    'deleted_id',
    'tonage',
  ];
}
