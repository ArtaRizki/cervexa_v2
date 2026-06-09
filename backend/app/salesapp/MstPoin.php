<?php

namespace App\salesapp;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class MstPoin extends Model
{
    protected $table = 'mst_poin';

    public function user()
    {
        return $this->hasOne(VUser::class, 'id', 'user_id');
    }

    public function scopeMaxMulai($query)
    {
        return $query->whereDate('mulai', '<=', Carbon::now()->toDateString())
            ->latest('mulai')
            ->pluck('mulai')
            ->first();
    }
}
