<?php

namespace App\driverapp;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AppDrvAccess extends Model
{
    protected $connection = 'dev';
    protected $table = 'app_driver_access';
    protected $fillable = [];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'karyawan_id');
    }
}
