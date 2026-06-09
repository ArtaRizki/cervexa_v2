<?php

namespace App\driverapp;

use Illuminate\Database\Eloquent\Model;

class TmpDrvOper extends Model
{
    protected $table = 'tmp_drv_oper';
    protected $fillable = [
        'reff',
        'nokend',
        'tonokend',
        'idprod',
        'ball',
        'pcs',
        'status',
        'alasan',
    ];

    public function rinci()
    {
        return $this->hasMany(TmpDrvOper::class, 'reff', 'reff');
    }
}
