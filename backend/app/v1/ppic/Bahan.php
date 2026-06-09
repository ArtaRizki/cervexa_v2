<?php

namespace App\v1\ppic;

use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    protected $table = 'mst_bahan';
    public function terima()
    {
        return $this->hasOne(BahanTerima::class, 'idbahan', 'idbahan')->orderBy('tanggal', 'desc');
    }
    public function trs()
    {
        return $this->hasMany(BahanTrs::class, 'idbahan', 'idbahan');
    }
    public function in()
    {
        return $this->hasMany(BahanTrs::class, 'idbahan', 'idbahan')->where('jenis', 'in');
    }
    public function out()
    {
        return $this->hasMany(BahanTrs::class, 'idbahan', 'idbahan')->where('jenis', 'out');
    }
}
