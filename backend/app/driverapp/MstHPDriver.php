<?php

namespace App\driverapp;

use App\User;
use Illuminate\Database\Eloquent\Model;

class MstHPDriver extends Model
{
    #protected $connection = 'dev';
    protected $table = 'mst_hp_driver';
    protected $fillable = [
        'androidId',
        'alias',
        'brand',
        'type',
        'sn',
        'karyawan_id',
        'user_id',
        'fcm',
    ];
    public function driver()
    {
        return $this->hasOne(User::class, 'id', 'karyawan_id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
