<?php

namespace App\v1\ppic;

use App\MstKendaraan;
use App\User;
use App\VUser;
use Illuminate\Database\Eloquent\Model;

class PermintaanJasa extends Model
{

    protected $table = 'trs_minta_jasa';

    protected $guarded = [];
    protected $dates = [
        'tanggal',
        'tgl_butuh',
        'created_at',
        'updated_at',
        'approved_at',
        'rejected_at',
        'confirmed_at',
    ];


    public function user()
    {
        return $this->hasOne(VUser::class, 'id', 'user_id');
    }
    public function approved()
    {
        return $this->hasOne(VUser::class, 'id', 'approved_user_id');
    }
    public function rejected()
    {
        return $this->hasOne(VUser::class, 'id', 'rejected_user_id');
    }
    public function confirmed()
    {
        return $this->hasOne(VUser::class, 'id', 'confirmed_user_id');
    }
    public function kendaraan()
    {
        return $this->hasOne(MstKendaraan::class, 'id', 'id_kend');
    }
}
