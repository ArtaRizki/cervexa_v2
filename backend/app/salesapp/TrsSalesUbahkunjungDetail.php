<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;

class TrsSalesUbahkunjungDetail extends Model
{
    protected $table = 'trs_sales_ubahkunjung_detail';
    protected $fillable = [
        'nopkh',
        'idcust',
        'nonota',
        'idprod',
        'isipeti',
        'isisatu',
        'turunpeti',
        'turunsatu',
        'bayarpeti',
        'bayarsatu',
        'nominal',
        'bayarnominal',
        'jenis',
        'isjadwal',
    ];
    public function header()
    {
        return $this->belongsTo(TrsSalesUbahkunjung::class, 'nopkh', 'nopkh');
    }
}
