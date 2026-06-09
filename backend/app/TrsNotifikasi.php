<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrsNotifikasi extends Model
{
    protected $table = 'trs_notifikasi';

    protected $fillable = [
        'title',
        'body',
        'to_id',
        'toTopics',
        'from_id',
        'data_id',
        'screen',
        'isPopup',
        'img',
        'url',
        'seen_at',
    ];

    protected $appends = ['to', 'from'];

    //Accessor
    public function getImgAttribute()
    {
        $res = "";
        return $res;
    }

    public function to()
    {
        return $this->hasOne(User::class, 'id', 'to_id');
    }

    public function from()
    {
        return $this->hasOne(User::class, 'id', 'from_id');
    }
}
