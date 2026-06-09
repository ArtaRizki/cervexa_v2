<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrsSalesRekap extends Model
{
  protected $table = 'trs_sales_rekap';

  protected $fillable = [
    "tanggal",
    "nokend",
    "nota",
    "diskon",
    "terima",
    "terima_trf",
    "terima_bank",
    "biaya_parkir",
    "harga_bbm",
    "biaya_bbm1",
    "biaya_bbm2",
    "biaya_ltr1",
    "biaya_ltr2",
    "sysdate",
    "biaya_cbbm1",
    "biaya_cbbm2",
    "cabang",
    "opr",
    "biaya_umcrew",
    "biaya_lain",
    "biaya_lainnote",
    "terima_kertas",
    "terima_logam",
    "kurang",
    "biaya_tol",
    "biaya_retribusi",
    "user_id",
  ];
}
