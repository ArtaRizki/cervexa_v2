<?php

namespace App\v1\direksi;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PODetail extends Model
{
    protected $table = 'trs_supp_bahan_po_det';

    public function user()
    {
        return $this->hasOne(VUser::class, 'id', 'user_id');
    }
    // public function po()
    // {
    //     // return PO::where('nonota', $this->nonota)->first();
    //     // return $this->hasOne(PO::class, 'nonota', 'nonota');
    // }
    public function detail()
    {
        return $this->belongsTo(PO::class, 'nonota', 'nonota');
    }
    public function pr()
    {
        return $this->hasOne(PR::class, 'id_pr', 'id_pr');
    }
}
