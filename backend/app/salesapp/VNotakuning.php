<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;
use App\JurHead;

class VNotakuning extends Model
{
    protected $table = 'v_notakuning_sqlsrv';

    public function getJurnalAttribute()
    {
        $jurnal = JurHead::on('pgsql')->select('tanggal', 'nokend', 'nobukti', 'updated_at')
            ->whereRaw("left(keterangan,9) = 'PENJUALAN'")
            ->where('tanggal', $this->tgl)
            ->where('nokend', $this->nokend)
            ->first();

        return $jurnal;
    }
}
