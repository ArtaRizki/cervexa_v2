<?php

namespace App\driverapp;

use App\Mstbahan;
use App\MstKendaraan;
use Illuminate\Database\Eloquent\Model;

class TrsDrvLapor extends Model
{
    protected $table = 'trs_drv_lapor';
    protected $guarded = [];

    public function kendaraan()
    {
        return $this->hasOne(MstKendaraan::class, 'id', 'kendaraan_id');
    }
    public function respon()
    {
        return $this->hasOne(TrsDrvLaporRespon::class, 'id', 'respon_id');
    }
}
