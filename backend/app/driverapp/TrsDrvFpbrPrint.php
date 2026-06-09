<?php

namespace App\driverapp;

use App\MstCustomer;
use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;

class TrsDrvFpbrPrint extends Model
{
    protected $table = 'trs_drv_fpbr_print';

    protected $fillable = [
        'tanggal',
        'nokend',
        'uid',
        'rev',
    ];
}
