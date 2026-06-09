<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;

class TrsSalesComplaintPhotos extends Model
{
    protected $table = 'trs_sales_complaint_photos';
    protected $fillable = [
        'idkomplain',
        'photo',
    ];
}
