<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;

class TrsSalesUbahkunjung extends Model
{
    protected $table = 'trs_sales_ubahkunjung';
    protected $fillable = [
        'tanggal',
        'nokend',
        'nopkh',
        'keterangan',
        'sales',
    ];
    public function detail()
    {
        return $this->hasMany(TrsSalesUbahkunjungDetail::class, 'nopkh', 'nopkh');
    }
}
