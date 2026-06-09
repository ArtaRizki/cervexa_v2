<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstJenisHarga extends Model
{
    protected $table = 'mst_jenis_harga';
    protected $fillable = [
        'id',
        'jenis',
        'alias',
        'color',
        'deskripsi',
        'created_at',
        'updated_at',
    ];

    public function customer()
    {
        return $this->hasMany(MstCustomer::class, 'jenis_harga', 'id');
    }
}
