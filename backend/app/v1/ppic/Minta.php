<?php

namespace App\v1\ppic;

use App\User;
use App\VUser;
use Illuminate\Database\Eloquent\Model;

class Minta extends Model
{

    protected $table = 'trs_minta_brg';
    protected $primaryKey = 'id_permintaan';



    //SCOPE
    public function scopeSearch($query, $cari = null)
    {
        $res = $query->where(function ($q) use ($cari) {
            $q->where('nama', 'like', '%' . $cari . '%');
        });
        return $res;
    }
    public function scopeStatus($query, $status = null)
    {
        switch ($status) {
            case 'value':
                # code...
                break;

            default:
                $res = '';
                break;
        }
        return $res;
    }
    public function scopeUserId($query, $user_id = null)
    {
        if ($user_id && $user_id != '') {
            $res = $query->where('user_id', $user_id);
        } else {
            $res = $query->where('user_id', auth()->user()->id);
        }
        return $res;
    }
    public function scopeBagianId($query, $bagian_id = null)
    {

        if ($bagian_id && $bagian_id != '') {
            $res =
                $query->whereHas('user', function ($subq) use ($bagian_id) {
                    return $subq->where('bagian_id', $bagian_id);
                })
                ->whereNotNull('submited_at');
        } else {
            $res =
                $query->whereHas('user', function ($subq) {
                    return $subq->where('bagian_id', auth()->user()->bagian_id);
                });
        }

        return $res;
    }

    //RELASI
    public function prBarang()
    {
        return $this->hasOne(PRBarang::class, 'id_permintaan', 'id_permintaan');
    }
    public function user()
    {
        return $this->hasOne(VUser::class, 'id', 'user_id');
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
