<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class BiayaMst extends Model
{
    protected $table = 'mst_biaya';    
    public function getIdAttribute($value)
    {
        return Crypt::encryptString($value);
    }
}
