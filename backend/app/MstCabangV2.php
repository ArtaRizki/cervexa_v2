<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstCabangV2 extends Model
{
    protected $table = 'mst_cabang_v2';

    public function scopeKotaAktif($query)
    {
        return $query->whereNull('status')->where('kdkota', '!=', '');
    }
}
