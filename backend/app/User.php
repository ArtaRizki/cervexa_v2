<?php

namespace App;

use App\v1\hrd\KaryawanNote;
use App\MstCabangV2;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;

// class User extends Model implements AuthenticatableContract, AuthorizableContract
class User extends Model implements JWTSubject, AuthenticatableContract
{
  use Authenticatable;

  protected $table = 'mst_karyawan_v2';
  // use Authenticatable, Authorizable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'email',
  ];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = [
    'password',
  ];

  /**
   * Get the identifier that will be stored in the subject claim of the JWT.
   *
   * @return mixed
   */
  public function getJWTIdentifier()
  {
    return $this->getKey();
  }

  /**
   * Return a key value array, containing any custom claims to be added to the JWT.
   *
   * @return array
   */
  protected $columns = [
    'id',

    'pribadi_id',
    'nip',
    'nfp',

    'join_date',
    'begin_date',
    'end_date',

    'resign_date',
    'resign_note',

    'status_id',
    'jabatan_id',
    'bagian_id',
    'pekerjaan_id',
    'lokasi_id',

    'username',
    'password',
    'remember_token',

    'user_id',

    'jenis',
    'jabat',
    'bagian',
    'pekerjaan',
    'status',
    'lokasi',
    'id_karyawan',
    'idkary',

    'lokasi_konsumen_admin',
  ];

  public function getJWTCustomClaims()
  {
    return [];
  }




  public function scopeExclude($query, $value = array())
  {
    return $query->select(array_diff($this->columns, (array) $value));
  }
  public function scopeSearch($query, $cari)
  {
    if ($cari && $cari != '') {
      return $res =
        $query->whereHas('pribadi', function ($subq) use ($cari) {
          return $subq->where('nama', 'LIKE', '%' . $cari . '%')
            ->orWhere('alias', 'LIKE', '%' . $cari . '%')
            ->orWhere('alamat', 'LIKE', '%' . $cari . '%');
        });
    }
  }
  public function akses()
  {
    return $this->belongsTo(Akses::class, 'id');
  }

  public function pribadi()
  {
    return $this->hasOne(Pribadi::class, 'karyawan_id');
  }

  public function status()
  {
    return $this->hasOne(Status::class, 'id', 'status_id');
  }

  public function bagian()
  {
    return $this->hasOne(Bagian::class, 'id', 'bagian_id');
  }
  public function pekerjaan()
  {
    return $this->hasOne(Pekerjaan::class, 'id', 'pekerjaan_id');
  }
  public function jabatan()
  {
    return $this->hasOne(Jabatan::class, 'id', 'jabatan_id');
  }

  public function lokasi()
  {
    return $this->hasOne(Lokasi::class, 'id', 'lokasi_id');
  }
  public function absensi()
  {
    return $this->hasMany(AttLogs::class, 'pin', 'nfp');
  }

  public function karir()
  {
    return $this->hasMany(TrsKarir::class, 'karyawan_id', 'id');
  }

  public function trsstatus()
  {
    return $this->hasMany(TrsStatus::class, 'karyawan_id', 'id');
  }
  public function fcm()
  {
    return $this->hasMany(FCMToken::class, 'user_id', 'id');
  }
  public function notes()
  {
    return $this->hasMany(KaryawanNote::class, 'karyawan_id', 'id');
  }
  public function mynotes()
  {
    return $this->notes()->where('user_id', auth()->user()->id);
  }
  public function inventarislogs()
  {
    return $this->hasMany(InventarisLogs::class, 'user_id', 'id');
  }

  public function getCabangNamaAttribute()
  {
    if ($this->cabang_id == null) {
      return [];
    } else {
      $id = explode(',', $this->cabang_id);
      // ARTA | START | FPP/MLG/2510004 - Variabel Environment | 08 Oktober 2025
      // $nama = MstCabangV2::on('dev')->selectRaw('RTRIM(cabang) cabang')->whereIn('id', $id)->get();
      $nama = MstCabangV2::on('sqlsrv')->selectRaw('RTRIM(cabang) cabang')->whereIn('id', $id)->get();
      // ARTA | END | FPP/MLG/2510004 - Variabel Environment | 08 Oktober 2025
      return $nama;
    }
  }
}
