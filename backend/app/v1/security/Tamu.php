<?php

namespace App\v1\security;

use App\Bagian;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    protected $table = 'trs_security_tamu';
    protected $dates = [
        'created_at',
        'updated_at',
        'jammasuk',
        'jampulang',
    ];
    // protected $appends = ['img'];
    // protected $fillable = [
    //     'title',
    //     'desc',
    //     'location',
    //     'res_at',
    //     'res_note',
    //     'res_user_id',
    //     'user_id',
    //     'lat',
    //     'long',
    //     'kategori',
    // ];
    //Accessor
    public function getImgAttribute()
    {
        $res = array_map(function ($link) {
            return "http://app.irasa.co.id/storage/img/hrd/tamu/" . basename($link);
        }, glob("../../irs/storage/app/public/img/hrd/tamu/*" . strtolower("$this->nomorid") . "*"));
        return $res;
    }

    //SCOPE
    public function scopeSearch($query, $cari = null)
    {
        $res = $query->where(function ($q) use ($cari) {
            $q->where('namatamu', 'like', '%' . $cari . '%');
            $q->orWhere('instansi', 'like', '%' . $cari . '%');
            $q->orWhere('keperluan', 'like', '%' . $cari . '%');
            $q->orWhere('bertemu', 'like', '%' . $cari . '%');
        });
        return $res;
    }
    public function scopeKategori($query, $kategori = null)
    {

        if ($kategori && $kategori != null) {
            $res = $query->where('kategori', $kategori);
        } else {
            $bagian = Bagian::where('id', auth()->user()->bagian_id)->first();
            $bagian = strtolower($bagian->bagian);
            switch ($bagian) {
                case 'hrd':
                    $res = $query->where('kategori', 'UMUM');
                    break;

                case 'produksi':
                    $res = $query->whereIn('kategori', ['TEKNIK', 'PRODUKSI']);
                    break;

                case 'it':
                    $res = $query->whereIn('kategori', ['IT', 'JARINGAN']);
                    break;
                default:
                    $res = $query;
                    break;
            }
            $res = $res->orWhere('user_id', auth()->user()->id);
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

    public function scopeUserId($query, $user_id = null)
    {
        if ($user_id && $user_id != '') {
            $res = $query->where('user_id', $user_id);
        } else {
            $res = $query->where('user_id', auth()->user()->id);
        }
        return $res;
    }

    //RELASI
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function riwayat()
    {
        return $this->hasMany(Tamu::class, 'nomorid', 'nomorid');
    }
}
