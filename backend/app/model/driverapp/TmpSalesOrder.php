<?php

namespace App\model\driverapp;

use App\driverapp\TrsDrvExp;
use App\MstCustomer;
use Illuminate\Database\Eloquent\Model;
use Awobaz\Compoships\Compoships;

class TmpSalesOrder extends Model
{
    use Compoships;
    protected $table = 'tmp_sales_order';

    public function rinci()
    {
        return $this->hasMany(TmpSalesRinci::class, 'nonota', 'nonota');
    }
    public function cust()
    {
        return $this->hasOne(MstCustomer::class, 'idcust', 'idcust');
    }
    public function nota()
    {
        return $this->hasOne(TrsSalesNota::class, 'nonota', 'nonota');
    }
    public function kirim()
    {
        return $this->hasMany(TrsDrvExp::class, 'nonota', 'nonota');
    }
}
