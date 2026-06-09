<?php

namespace App\driverapp;

use App\MstCustomer;
use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;

class TrsDrvExp extends Model
{
  use Compoships;

  // protected $connection = 'dev';
  protected $table = 'trs_drv_expdate';
  protected $fillable = [
    'tanggal',
    'nokend',
    'idcust',
    'idprod',
    'jenis',
    'expdate',
    'kodeproduksi',
    'jmlpeti',
    'jmlsatu',
    'opr',
    'sysdate',
    'tgl_create',
    'cabang',
    'idprod_ss',
    'nourut',
    'ket',
    'kodeqr',
    'nonota',
    'keluhan',
    'scan_at',
    'user_id',
    'deleted_at',
    'deleted_id',
    'tonage',
  ];

  public function customers()
  {
    return $this->hasOne(MstCustomer::class, 'idcust', 'idcust');
  }

  public function rinciKanvas()
  {
    return $this->hasOne(TmpSalesRinci::class, ['nonota', 'idprod'], ['nonota', 'idprod']);
  }

  public static function getSqlWithBindings($query)
  {
    return vsprintf(str_replace('?', '%s', $query->toSql()), collect($query->getBindings())->map(function ($binding) {
      return is_numeric($binding) ? $binding : "'{$binding}'";
    })->toArray());
  }
}
