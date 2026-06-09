<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;

class TrsMintamuat extends Model
{
    protected $table = 'trs_mintamuat';
    protected $fillable = [
        'iddaerah',
        'tanggal',
        'pasar',
        'idprod',
        'jumlah',
        'sales',
        'nonota',
        'cabang',
        'jumlah_pcs',
    ];
}
