<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventarisLogs extends Model
{
    protected $table = 'mst_inventaris_log';
    protected $fillable = [
        'inventaris_id',
        'keterangan',
        'user_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
