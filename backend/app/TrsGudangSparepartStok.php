<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TrsGudangSparepartStok extends Model {
	protected $table = 'trs_gudang_sparepart_stok';
	protected $guarded = [];
	public function user() {
		return $this->hasOne(VUser::class, 'id', 'user_id');
	}
	public function barang() {
		return $this->hasOne(MstBarangGA::class, 'idbarang', 'barang_id');
	}
	public function riwayat() {
		return $this->hasMany(TrsGudangSparepartStok::class, 'barang_id', 'barang_id')->latest()->select('qty', 'created_at');
	}
}
