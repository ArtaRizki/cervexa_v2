<?php

namespace App\salesapp;

use Illuminate\Database\Eloquent\Model;
use App\MstKendaraan;
use App\VUser;
use App\salesapp\TrsDiskonAkumulasi;

class TrsDiskonAkumulasiHistori extends Model
{
  protected $table = 'trs_diskon_akumulasi_histori';
  // protected $guarded = [];
  protected $fillable = [
    'id_diskon',
    'nonota',
    'noso',
    'nominal_terpakai',
    'cancel_at',
    'cancel_id',
    'user_id'
  ];
  protected $casts = [
    'id_diskon' => 'integer',
    'nominal_terpakai' => 'float',
    'cancel_id' => 'integer',
    'user_id' => 'integer',
    'cancel_at' => 'datetime', // Untuk kolom datetime yang bisa null
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
  ];
  public function diskonAkumulasi()
  {
    return $this->belongsTo(TrsDiskonAkumulasi::class, 'id_diskon', 'id');
  }
}
