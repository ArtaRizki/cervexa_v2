<?php

namespace App\v1\gudang;

use App\MstBarangGA;
use App\User;
use App\VUser;
use Illuminate\Database\Eloquent\Model;

class GudangSparepart extends Model
{
    protected $table = 'trs_gudang_sparepart';
    protected $guarded = ['id'];

    public function barang()
    {
        return $this->hasOne(MstBarangGA::class, 'idbarang', 'barang_id');
    }
    public function user()
    {
        return $this->hasOne(VUser::class, 'id', 'user_id');
    }
}
