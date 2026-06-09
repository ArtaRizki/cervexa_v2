<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pribadi extends Model
{
    protected $table = 'mst_karyawan_pribadi';
    protected $appends = ['img'];
    //Accessor
    public function getImgAttribute()
    {
        $res = [];
        return $res;
    }

    public function apply()
    {
        return $this->hasOne(pekerjaan::class, 'id', 'pekerjaan_id');
    }

    public function keluarga()
    {
        return $this->hasMany(KaryawanKeluarga::class, 'pribadi_id', 'id');
    }
    public function pendidikan()
    {
        return $this->hasMany(KaryawanPendidikan::class, 'pribadi_id', 'id');
    }
    public function pengalaman()
    {
        return $this->hasMany(KaryawanPengalaman::class, 'pribadi_id', 'id');
    }
    public function pekerjaan()
    {
        return $this->hasOne(Pekerjaan::class, 'id', 'pekerjaan_id');
    }

    public function karyv1()
    {
        return $this->hasOne(MstKaryawan::class, 'noktp', 'nik');
    }
}
