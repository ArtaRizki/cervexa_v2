<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstCustomer extends Model
{
  protected $table = 'mst_customer';
  protected $fillable = [
    'idcust',
    'daerah',
    'nama',
    'namatoko',
    'npwp',
    'telp1',
    'telp2',
    'ktp_nik',
    'jeniscust',
    'koordinat',
    'waktu_scanqr',
    'status',
    'ktp_nama',
    'ktp_alamat',
    'ktp_rt',
    'ktp_rw',
    'ktp_desa',
    'ktp_camat',
    'ktp_kabkodya',
    'alamat',
    'nopkb',
    'carabayar',
    'waktu_pkb',
    'sales_pkb',
    'tmp_telp',
    'waktu_tmp_telp',
    'sales_tmp_telp',
    'cabang',
    'jenis_harga',
    'typeoutlet',
    'typesalesman',
    'hirarkioutlet',
  ];
  public function daerah()
  {
    return $this->hasMany(MstDaerah::class, 'daerah', 'daerah');
  }
  public function daerahMax()
  {
    return $this->hasOne(MstDaerah::class, 'daerah', 'daerah')->maxTgl();
  }

  public function scopeAktif($query)
  {
    return $query->where('status', '');
  }

  public function scopeIdcust($query, $daerah, $customer)
  {
    return $query->where(function ($q) use ($daerah, $customer) {
      $q->where('daerah', 'LIKE', '%' . $daerah . '%');
      $q->where('nama', 'LIKE', '%' . $customer . '%');
    });
  }

  public function notaKuning()
  {
    return $this->belongsTo(TmpSalesNota::class, 'idcust', 'idcust');
  }

  public function jenisHargaDetail()
  {
    return $this->belongsTo(MstJenisHarga::class, 'jenis_harga', 'id');
  }
}
