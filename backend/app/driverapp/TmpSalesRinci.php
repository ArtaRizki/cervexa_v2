<?php

namespace App\driverapp;

use App\Mstbahan;
use App\MstCustomer;
use Illuminate\Database\Eloquent\Model;

class TmpSalesRinci extends Model
{
    use \Awobaz\Compoships\Compoships;
    protected $table = 'tmp_sales_rinci';
    protected $guarded = [];
    public $timestamps = false;
    public function cust()
    {
        return $this->hasOne(MstCustomer::class, 'idcust', 'idcust');
    }
}
