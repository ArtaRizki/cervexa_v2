<?php

namespace App\v1\direksi;

use App\User;
use App\v1\ppic\Minta;
use App\v1\ppic\Permintaan;
use App\VUser;
use Illuminate\Database\Eloquent\Model;

class PR extends Model
{
    protected $table = 'trs_pr';


    public function user()
    {
        return $this->hasOne(VUser::class, 'id', 'user_id');
    }

    public function rinci()
    {
        return $this->hasMany(PRRinci::class, 'no', 'no');
    }

    public function permintaan()
    {
        return $this->hasOne(Minta::class, 'id_permintaan', 'id_permintaan');
    }
}
