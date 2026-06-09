<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TmpSalesRinci extends Model
{
  protected $table = 'tmp_sales_rinci';

  protected $fillable = [
    'tanggal',
    'nokend',
    'nonota',
    'idcust',
    'idprod',
    'jualpeti',
    'jualsatu',
    'turunpeti',
    'turunsatu',
    'bspeti',
    'bssatu',
    'satuan',
    'jumlah',
    'poin',
    'tgl_create',
    'sales',
    'status_barang',
    'confirm_at',
    'confirmbs_at',
  ];

  public function customer()
  {
    return $this->hasOne(MstCustomer::class, 'idcust', 'idcust');
  }

  public function rekap()
  {
    return $this->belongsTo(TmpSalesNota::class, 'nonota', 'nonota');
  }
}
