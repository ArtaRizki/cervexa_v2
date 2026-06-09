<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProduksiTrs extends Model
{
    protected $table = 'trs_produksi';

    public function karyv1()
    {
        return $this->hasOne(MstKaryawan::class, 'idkary', 'idkary');
    }
}
