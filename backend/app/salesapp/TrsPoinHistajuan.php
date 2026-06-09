<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;

class TrsPoinHistajuan extends Model
{
    protected $table = 'trs_poin_histajuan';
    protected $fillable = [
        'cutoff',
        'created_id',
    ];
}
