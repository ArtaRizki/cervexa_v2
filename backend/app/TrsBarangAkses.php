<?php

namespace App;

use App\v1\ppic\PermintaanBrg;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TrsBarangAkses extends Model {
	protected $table = 'trs_akses_barang';
	protected $guarded = [];

	public function permintaan() {
		return $this->hasMany(PermintaanBrg::class, 'jenis_id', 'jenis_id');
	}
}
