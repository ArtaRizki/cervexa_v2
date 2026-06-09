<?php

namespace App\driverapp;

use Illuminate\Database\Eloquent\Model;

class SisaKelilinganTrs extends Model
{
  protected $table = 'trs_sisa_kelilingan';

  protected $fillable = [
    "user_id",
    "tanggal",
    "note",
    "nokend",
    "cabang",
    // START | ADIT | 9/12/24 | FPP/MLG/2408037 | untuk fitur cetak sisa kelilingan, agar catatan_revisi dan counter_revisi bisa diupdate 
    "catatan_revisi",
    "counter_revisi",
    //  END  | ADIT | 9/12/24 | FPP/MLG/2408037 | untuk fitur cetak sisa kelilingan, agar catatan_revisi dan counter_revisi bisa diupdate 
  ];
}
