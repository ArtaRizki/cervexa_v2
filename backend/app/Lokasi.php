<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $table = 'mst_lokasi';

    public function cabang()
    {
        return $this->hasOne(MstCabangV2::class, 'id', 'cabang_id');
    }
}
