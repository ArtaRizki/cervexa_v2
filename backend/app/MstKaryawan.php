<?php

namespace App;

use App\driverapp\TrsDrvRekap;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class MstKaryawan extends Model
{
    protected $table = 'mst_karyawan';

    public function drvrekap()
    {
        return $this->hasOne(TrsDrvRekap::class, 'driver', 'nama')->where('tanggal', Carbon::now()->toDateString());
    }
    public function pribadi()
    {
        return $this->hasOne(Pribadi::class, 'nik', 'nik');
    }
}
