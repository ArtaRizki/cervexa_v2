<?php

namespace App\v1\direksi;

use App\User;
use App\v1\ppic\Permintaan;
use App\VUser;
use Illuminate\Database\Eloquent\Model;

class PRRinci extends Model
{
    protected $table = 'trs_pr';

    public function permintaan()
    {
        return $this->hasOne(Permintaan::class, 'id_permintaan', 'id_permintaan');
    }
}
