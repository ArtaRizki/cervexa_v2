<?php

namespace App\v1\ppic;

use App\MstSupplier;
use App\v1\direksi\PO;
use App\v1\direksi\PODetail;
use Illuminate\Database\Eloquent\Model;

class BahanBeli extends Model
{
    protected $table = 'trs_supp_beli';

    public function supplier()
    {
        return $this->hasOne(MstSupplier::class, 'idsupp', 'idsupp');
    }
}
