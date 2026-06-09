<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Awobaz\Compoships\Compoships;

class TrsSalesRinci extends Model
{
    use Compoships;

    protected $table = 'trs_sales_rinci';

    protected $fillable = [
      'tanggal',
      'nokend',
      'nonota',
      'idcust',
      'idprod',
      'jualpeti',
      'jualsatu',
      'sample',
      'bspeti',
      'bssatu',
      'satuan',
      'jumlah',
      'jml_bs',
      'diskon',
      'poinbrg',
      'poin',
      'poinplus',
      'ambiltitip',
      'poinret',
      'idprodold',
      'tgl_create',
      'cabang',
      'idcustcab',
      'poinf',
      'oldjualpeti',
      'oldjualsatu',
      'idcustold',
      'ppn_satuan',
      'ppn_jumlah',
      'ppn_diskon',
      'ppn_dpp',
      'ppn_bayar',
      'idprod_ss',
      'status_barang',
      'turunsatu',
      'turunpeti',
      'opr',
      'sales',
      'keterangan',
      'tglnotajual',
      'tglnotabs',
      'confirmbs_at',
      'confirm_at',
      'poin_promo',
      'user_id',
      'created_at',
      'updated_at',
      'tgl_print',
      'batalnotabayar',
      'poinbeforev',
      'poinplusbeforev',
      'idcust22',
      'poin_excl',
      'jualsachet',
      'tgl_ajuan_sampel',
    ];

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
