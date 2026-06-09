<?php

namespace App\driverapp;

use App\model\driverapp\TmpSalesOrder;
use App\model\driverapp\TrsSalesNota;
use App\MstKendaraan;
use Illuminate\Database\Eloquent\Model;
use Awobaz\Compoships\Compoships;

class TrsDrvRekap extends Model
{
    use Compoships;
    protected $table = 'trs_drv_rekap';
    protected $fillable = [
        'tanggal',
        'nokend',
        'iddaerah',
        'sales',
        'sales_opr',
        'jambrkt',
        'berangkat',
        'datang',
        'spbu',
        'kmb',
        'kmi',
        'kmd',
        'opr',
        'cabang',
        'sysdate',
    ];
    public function kendaraan()
    {
        return $this->hasOne(MstKendaraan::class, 'nokend', 'nokend');
    }
    public function order()
    {
        return $this->hasMany(TmpSalesOrder::class, ['tanggal_kirim', 'nokend'], ['tanggal', 'nokend']);
        // ->where('status', '');
    }
    public function nota()
    {
        return $this->hasMany(TrsSalesNota::class, ['tanggal', 'nokend'], ['tanggal', 'nokend']);
    }
}
