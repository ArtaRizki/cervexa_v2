<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstCustomerRoChange extends Model
{
  protected $table = 'mst_customer_ro_change';

  public function customer() {
    return $this->belongsTo(MstCustomer::class, 'idcust', 'idcust');
  }
}
