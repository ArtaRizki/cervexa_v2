<?php

namespace App\v1\ppic;

use Illuminate\Database\Eloquent\Model;

class PO extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'approved_at',
        'rejected_at',
        'canceled_at',
    ];
}
