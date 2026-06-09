<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;

class TrsSalesMktNota extends Model
{
    protected $table = 'trs_sales_mkt_nota';
    protected $fillable = [
        'image',
    ];

    public $timestamps = false;
}
