<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;

class TmpCustomer extends Model
{
    protected $table = 'tmp_customer';
    protected $fillable = [
        'nopkb',
        'tanggal',
        'nama',
        'ktp',
        'npwp',
        'alamatrumah',
        'alamatusaha',
        'daerah',
        'telp1',
        'telp2',
        'carabayar',
        'kel',
        'sales',
    ];
}
