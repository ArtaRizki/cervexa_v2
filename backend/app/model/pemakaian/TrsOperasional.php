<?php

namespace App\model\pemakaian;

use Illuminate\Database\Eloquent\Model;

class TrsOperasional extends Model
{
    protected $table = 'trs_operasional';
    protected $fillable = [
        'tanggal',
        'periode',
        'awal',
        'akhir',
        'jenis',
        'petugas',
        'sysdate',
        'meteran',
    ];
    public $timestamps = false;
}
