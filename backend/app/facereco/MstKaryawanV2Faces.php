<?php

namespace App\facereco;

use Illuminate\Database\Eloquent\Model;

class MstKaryawanV2Faces extends Model
{
    protected $table = 'mst_karyawan_v2_faces';
    protected $fillable = [
        'nik',
        'kiri',
        'atas',
        'kanan',
        'bawah',
        'created_at',
    ];
    public $timestamps = true;
}
