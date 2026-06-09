<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;
use App\MstKendaraan;
use App\VUser;

class TrsDiskonAkumulasi extends Model
{
  protected $table = 'trs_diskon_akumulasi';
  // protected $guarded = [];
  protected $fillable = [
    'idcust',
    'periode',
    'total_poin',
    'nominal_transaksi',
    'diskon',
    'nominal_diskon',
    'sisa'
  ];
  protected $casts = [
    'total_poin' => 'integer',
    'nominal_transaksi' => 'float',
    'diskon' => 'float',
    'nominal_diskon' => 'float',
    'sisa' => 'float', 
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
  ];

  // public function user()
  // {
  //   return $this->hasOne(VUser::class, 'id', 'user_id');
  // }

  // public function cetak()
  // {
  //   return $this->hasOne(VUser::class, 'id', 'print_id');
  // }

  // public function kirim()
  // {
  //   return $this->hasOne(VUser::class, 'id', 'kirim_id');
  // }

  // public function kendaraan()
  // {
  //   return $this->hasOne(MstKendaraan::class, 'id', 'kend_id');
  // }

  // public function tolakDriver()
  // {
  //   return $this->hasOne(VUser::class, 'id', 'cancel_id');
  //   //->driver();
  // }

  // public function tolakNotDriver()
  // {
  //   return $this->hasOne(VUser::class, 'id', 'cancel_id')
  //     ->notDriver()
  //     ->where('tanggal', '1900-01-01');
  // }

  // public function terima()
  // {
  //   return $this->hasOne(VUser::class, 'id', 'terima_id');
  // }

  // public function getImgAttribute()
  // {
  //   if (empty($this->photo)) {
  //     return [];
  //   } else {
  //     $img = array_map(function ($res) {
  //       return array(
  //         'url' => url('img/penjualan/terimagift/' . basename($res)),
  //         'name' => basename($res),
  //       );
  //     }, glob('../public/img/penjualan/terimagift/' . $this->photo));
  //     return $img;
  //   }
  // }
}
