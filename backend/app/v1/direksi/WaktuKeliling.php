<?php

namespace App\v1\direksi;

use App\MstCustomer;
use Illuminate\Database\Eloquent\Model;

class WaktuKeliling extends Model
{
    protected $table = 'trs_sales_wk';


    public function cust()
    {
        return $this->hasOne(MstCustomer::class, 'idcust', 'idcust');
    }
}
