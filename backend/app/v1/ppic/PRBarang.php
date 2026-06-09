<?php

namespace App\v1\ppic;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PRBarang extends Model
{
    protected $table = 'trs_pr';
    protected $primaryKey = 'id_pr';
    protected $dates = [
        'created_at',
        'updated_at',
        'approved_at',
        'rejected_at',
        'canceled_at',
    ];

    //RELASI
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function approved()
    {
        return $this->hasOne(User::class, 'id', 'approved_user_id');
    }

    public function rejected()
    {
        return $this->hasOne(User::class, 'id', 'rejected_user_id');
    }
}
