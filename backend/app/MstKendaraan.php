<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstKendaraan extends Model
{
    protected $table = 'mst_kendaraan';

    // public function getStandbyAttribute()
    // {
    //     $data = KendaraanLogs::selectRaw('keperluan, jamkeluar')
    //         ->where('nokend', $this->nokend)
    //         ->whereNull('jammasuk')
    //         ->first();
    //     return
    //         $data;
    // }
    public function logs()
    {
        return $this->hasMany(KendaraanLogs::class, 'nokend', 'nokend');
    }
    public function onduty()
    {
        return $this->hasOne(KendaraanLogs::class, 'nokend', 'nokend')->whereNull('jammasuk');
    }

    public function bahanbakar()
    {
        return $this->hasOne(MstBBM::class, 'jenis', 'bbm')
            ->maxMulai();
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 1);
    }

    public function scopeKelilingan($query)
    {
        return $query->where('jenis', 'kelilingan');
    }
}
