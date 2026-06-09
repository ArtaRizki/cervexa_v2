<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrsSerahTerimaKasBesar extends Model
{
  protected $table = 'trs_serah_terima_kas_besar';

  protected $fillable = [
    "created_at",
    "updated_at",
    "deleted_at",
    "amount",
    "depo",
    "create_id",
    "acc_at",
    "acc_id",
    "nomor",
    "tanggal",
  ];
}
