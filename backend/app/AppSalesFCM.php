<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppSalesFCM extends Model
{
    protected $table = 'app_sales_fcm';
    protected $fillable = ['karyawan_id', 'token'];
}