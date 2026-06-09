<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAuthTry extends Model
{

    //protected $table = 'v1_karyawan';

    protected $table = 'tes_user';
    // protected $connection = 'dev';
    protected $fillable = [
        'imei',
        'nama',
        'id',
        'bagian',
    ];

    public $timestamps = false;
    // protected $table = 'test_hris';
    // public function mintajasa()
    // {
    //     return $this->hasMany(PermintaanJasa::class, 'user_id', 'id')->where('nokend', $this->nokend);
    // }

}
