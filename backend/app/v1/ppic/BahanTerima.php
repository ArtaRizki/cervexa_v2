<?php

namespace App\v1\ppic;

use App\MstSupplier;
use App\v1\direksi\PO;
use App\v1\direksi\PODetail;
use Illuminate\Database\Eloquent\Model;

class BahanTerima extends Model
{
    protected $table = 'trs_supp_bahan_terima';
    public function supplier()
    {
        return $this->hasOne(MstSupplier::class, 'idsupp', 'idsupp');
    }
    public function po()
    {
        return $this->hasOne(PO::class, 'nonota', 'nonotapo');
    }
    public function podetail()
    {
        return $this->hasOne(PODetail::class, 'nonota', 'nonotapo');
    }
    public function beli()
    {
        return $this->hasOne(BahanBeli::class, 'nonota', 'nonota');
    }
}
