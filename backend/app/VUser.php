<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VUser extends Model
{

  protected $table = 'v_api_karyawan';

  public function scopeNama($query, $param)
  {
    return $query->where(function ($q) use ($param) {
      $q->where('nama_lama', 'LIKE', '%' . $param . '%');
    });
  }

  public function scopeIdentity($query, $param)
  {
    // $tmp = $query->where('nama_lama', $param)->pluck('id');
    $tmp = $query->where([
      ['nama_lama', 'LIKE', '%'.$param.'%'],
      ['jenis', '!=', 'Resign'],
    ])->pluck('id');
    $tmp = str_replace(']', '', $tmp);
    $tmp = str_replace('[', '', $tmp);
    return $tmp;
  }

  public function scopeAktif($query)
  {
    return $query->where('jenis', '<>', 'Resign');
  }

  public function scopeNotDriver($query)
  {
    $driver = VUser::aktif()->where('pekerjaan', 'Driver')->get()->pluck('id')->toArray();
    return $query->whereNotIn('id', $driver);
  }

  public function scopeDriver($query)
  {
    $driver = VUser::aktif()->where('pekerjaan', 'Driver')->get()->pluck('id')->toArray();
    return $query->whereIn('id', $driver);
  }
}
