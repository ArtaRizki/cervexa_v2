<?php

namespace App\v1\hrd;

use App\User;
use Illuminate\Database\Eloquent\Model;

class KaryawanNote extends Model
{
    protected $table = 'trs_karyawan_notes';
    protected $fillable = [
        'karyawan_id',
        'rating',
        'title',
        'user_id',
    ];
    public function scopeUserId($query, $user_id = null)
    {
        if ($user_id && $user_id != '') {
            $res = $query->where('user_id', $user_id);
        } else {
            $res = $query->where('user_id', auth()->user()->id);
        }
        return $res;
    }
    public function karyawan()
    {
        return $this->hasOne(User::class, 'id', 'karyawan_id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
