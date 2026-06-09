<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    protected $table = 'mst_inventaris';
    protected $fillable = [
        'noseri',
        'golongan',
        'kategori',
        'jenis',
        'nama',
        'lokasi',
        'divisi',
        'pemakai',
        'status',
        'keterangan',
        'opname',
        'user_id',
    ];
}
