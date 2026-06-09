<?php

namespace App\v1\direksi;

use App\MstSupplier;
use App\VUser;
use Illuminate\Database\Eloquent\Model;

class PO extends Model
{
    protected $table = 'trs_supp_bahan_po';

    public function user()
    {
        return $this->hasOne(VUser::class, 'id', 'user_id');
    }
    public function supplier()
    {
        return $this->hasOne(MstSupplier::class, 'idsupp', 'idsupp');
    }

    public function detail()
    {
        return $this->hasMany(PODetail::class, 'nonota', 'nonota');
    }
}
