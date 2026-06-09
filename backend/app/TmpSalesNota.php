<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TmpSalesNota extends Model
{
  protected $table = 'tmp_sales_nota';

  protected $fillable = [
    'tanggal',
    'nonota',
    'idcust',
    'jumlah',
    'jmlbayar',
    'cabang',
    'poin',
    'catatan',
    'diskon',
    'diskonlain',
    'netto',
    'waktu_awal',
    'waktu_akhir',
    'lokasi',
    'nokend',
    'jml_cetak',
    'noso',
    'prsdisklain',
    'carabayar',
    'custbank',
    'nobuktibayar',
    'bayar_bank',
    'bayar_trf',
    'bayar_tunai',
    'banknorek',
    'carabayar2',
    'custbank2',
    'nobuktibayar2',
    'bayar_bank2',
    'bayar_trf2',
    'bayar_tunai2',
    'banknorek2',
    'notes_sales',
    'sales',
    'apk_versi',
  ];

  public function customer()
  {
    return $this->hasOne(MstCustomer::class, 'idcust', 'idcust');
  }

  public function rinci()
  {
    return $this->hasMany(TmpSalesRinci::class, 'nonota', 'nonota');
  }
}
