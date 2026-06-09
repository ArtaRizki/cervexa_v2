<?php

namespace App\salessupport;

use Illuminate\Database\Eloquent\Model;

class TrsSalesSupport extends Model
{
    protected $table = 'trs_sales_supports';
    protected $fillable = [
        'tanggal',
        'sales',
        'idsupport',
        'status',
    ];
}
