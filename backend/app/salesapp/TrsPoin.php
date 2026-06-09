<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;
use App\MstKendaraan;
use App\VUser;

class TrsPoin extends Model
{
    protected $table = 'trs_poin';

    public function user()
    {
        return $this->hasOne(VUser::class, 'id', 'user_id');
    }

    public function cetak()
    {
        return $this->hasOne(VUser::class, 'id', 'print_id');
    }

    public function kirim()
    {
        return $this->hasOne(VUser::class, 'id', 'kirim_id');
    }

    public function kendaraan()
    {
        return $this->hasOne(MstKendaraan::class, 'id', 'kend_id');
    }

    public function tolakDriver()
    {
        return $this->hasOne(VUser::class, 'id', 'cancel_id');
        //->driver();
    }

    public function tolakNotDriver()
    {
        return $this->hasOne(VUser::class, 'id', 'cancel_id')
            ->notDriver()
            ->where('tanggal', '1900-01-01');
    }

    public function terima()
    {
        return $this->hasOne(VUser::class, 'id', 'terima_id');
    }

    public function getImgAttribute()
    {
        // ADIT | START | FPP/MLG/2509018 - Implementasi NAS Storage | 15 Januari 2026
        if (empty($this->photo)) {
            return [];
        } else {
            $img = array_map(function ($res) {
                return array(
                    'url' => url('storage/img/penjualan/terimagift_dev/' . basename($res)),
                    'name' => basename($res),
                );
            }, glob(env('STORAGE_PATH') . 'img/penjualan/terimagift_dev/' . $this->photo));
            return $img;
        }
        // ADIT |  END  | FPP/MLG/2509018 - Implementasi NAS Storage | 15 Januari 2026
    }
}
