<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FCMToken extends Model
{
    protected $table = 'trs_app_fcm';
    protected $fillable = [
        'user_id',
        'token',
        'androidId',
    ];
}
