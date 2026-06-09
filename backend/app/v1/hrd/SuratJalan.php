<?php

namespace App\v1\hrd;

use App\User;
use App\VUser;
use Illuminate\Database\Eloquent\Model;

class SuratJalan extends Model
{
    protected $table = 'trs_suratjalan';
    protected $fillable = [
        'no',
        'nokend',
        'kendaraan',
        'kepada',
        'alamat',
        'dari',
        'note',

        'qty',
        'satuan',
        'item',

        'keluar',
        'user_id_security',

        'user_id',
    ];
    public function rinci()
    {
        return $this->hasMany(SuratJalan::class, 'no', 'no');
    }
    public function security()
    {
        return $this->hasOne(VUser::class, 'id', 'user_id_security');
    }
}
