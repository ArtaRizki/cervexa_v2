<?php

namespace App;

use App\VUser;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model {

	protected $table = 'notifikasi';
	protected $fillable = ['type', 'from', 'to', 'text', 'desc', 'url', 'seen', 'id_karyawan', 'to_bagian'];

  public function karyawan() {
		return $this->hasOne(VUser::class, 'id', 'id_karyawan');
	}

}
