<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;

class TrsSalesCompetitorPhotos extends Model
{
    protected $table = 'trs_sales_competitor_photos';
    protected $fillable = [
        'idkompetitor',
        'photo',
    ];
}
