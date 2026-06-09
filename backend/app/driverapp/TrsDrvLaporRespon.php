<?php

namespace App\driverapp;

use App\Mstbahan;
use App\MstKendaraan;
use App\VUser;
use Illuminate\Database\Eloquent\Model;

class TrsDrvLaporRespon extends Model
{
    protected $table = 'trs_drv_lapor_respon';
    protected $guarded = [];

    public function lapor()
    {
        return $this->belongsTo(TrsDrvLapor::class, 'respon_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(VUser::class, 'id', 'user_id');
    }
}
