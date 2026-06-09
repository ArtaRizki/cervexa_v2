<?php

namespace App\v1\direksi;

use App\VUser;

use Illuminate\Database\Eloquent\Model;

class PRBahan extends Model
{
    protected $table = 'trs_bahan_pr';

    public function user()
    {
        return $this->hasOne(VUser::class, 'id', 'id_karyawan');
    }

    public function rinci()
    {
        return $this->hasMany(PRBahanRinci::class, 'urut', 'urut');
    }
}
