<?php

namespace App\v1\security;

use App\Bagian;
use App\MstKendaraan;
use App\User;
use Illuminate\Database\Eloquent\Model;

class KendaraanLogs extends Model
{
    protected $table = 'trs_security_kendaraan';
    protected $fillable = [
        'tamu_id',
        'nokend',
        'namamobil',
        'pengemudi',
        'sales',
        'helper',
        'keperluan',
        'jamkeluar',
        'jammasuk',
        'keterangan',
        'petugas_keluar',
        'petugas_masuk',
        'user_id_keluar',
        'user_id_masuk',
        'user_id',
    ];
    public function save(array $options = array())
    {
        $this->user_id = auth()->user()->id;
        parent::save($options);
    }

    protected $appends = ['img'];

    //Accessor
    public function getImgAttribute()
    {
        $res = [];
        return $res;
    }

    //SCOPE
    public function scopeSearch($query, $cari = null)
    {
        $res = $query->where(function ($q) use ($cari) {
            $q->where('pengemudi', 'like', '%' . $cari . '%');
            $q->orWhere('nokend', 'like', '%' . $cari . '%');
        });
        return $res;
    }
    public function scopePemilik($query, $param)
    {
        $kendPabrik = MstKendaraan::selectRaw('RTRIM(nokend) nokend')->get()->pluck('nokend')->toArray();

        switch ($param) {
            case 'PABRIK':
                return $sql = $query->whereIn('nokend', $kendPabrik);
                break;
            case 'TAMU':
                return $sql = $query->whereNotIn('nokend', $kendPabrik);
                break;
            default:
                break;
        }
    }

    //RELASI
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
