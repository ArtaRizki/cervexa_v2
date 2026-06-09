<?php

namespace App\driverapp;

use Illuminate\Database\Eloquent\Model;

class MstHPDriver2 extends Model
{
    protected $table = 'mst_hp_drivers';
    protected $fillable = [
        'nohp',
        'driver',
        'password',
    ];
}
