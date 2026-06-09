<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstBankJual extends Model
{
    protected $table = 'mst_bank_jual';

    public function scopeNorek($query, $jenis)
    {
        $tmp = $query->where('jenis', $jenis)
            ->pluck('norek');
        $tmp = str_replace('[', '', $tmp);
        $tmp = str_replace(']', '', $tmp);
        $tmp = str_replace('"', '', $tmp);
        return $tmp;
    }
}
