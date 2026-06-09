<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;

class MstCustomerDraftPhotos extends Model
{
    protected $table = 'mst_customer_draft_photos';
    protected $fillable = [
        'idcust',
        'photo',
    ];
}
