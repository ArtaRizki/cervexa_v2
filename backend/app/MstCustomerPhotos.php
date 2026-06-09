<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstCustomerPhotos extends Model
{
    protected $table = 'mst_customer_photos';
    protected $fillable =[
        'idcust',
        'photo',
    ];
}