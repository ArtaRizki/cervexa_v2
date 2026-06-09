<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;

class MstParameterPkb extends Model
{
    protected $table = 'mst_parameter_pkb';

    protected $primaryKey = 'id';

    protected $fillable = [
        'kategori',
        'nama',
        'is_active',
    ];

    public $timestamps = false;

    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    public function scopeAktif($query)
    {
        return $query->where('is_active', 1);
    }
}
