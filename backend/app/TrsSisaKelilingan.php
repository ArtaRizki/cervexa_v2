<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrsSisaKelilingan extends Model
{
    protected $table = 'trs_sisa_kelilingan';

    protected $fillable = [
        "user_id",
        "tanggal",
        "note",
        "nokend",
        "cabang",
        "catatan_revisi",
        "counter_revisi",
        'created_at',
        'updated_at',
    ];
}
