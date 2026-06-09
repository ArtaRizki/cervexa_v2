<?php

namespace App;

use App\v1\ppic\PermintaanBrg;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TrsBarangKeluar extends Model {
	protected $table = 'trs_barang_keluar';
	protected $guarded = [];
	protected $appends = ['bon'];

	public function permintaan() {
		return $this->hasOne(PermintaanBrg::class, 'id_permintaan', 'id_permintaan');
	}
	
	public function penerima() {
		return $this->hasOne(VUser::class, 'id', 'id_karyawan');
	}

	public function user() {
		return $this->hasOne(VUser::class, 'id', 'user_id');
	}

	public function rinci() {
		return $this->hasMany(TrsBarangKeluar::class, 'no_keluar', 'no_keluar')->whereNull('cancel_at');
	}

	public function getBonAttribute() {
			// return Str::afterLast($this->no_keluar, '/');
		$img = array_map(function ($res) {
			return [
				'url' => url('img/hrd/ga/pengeluaranbarang/' . basename($res)),
				'name' => basename($res),
			];
		}, glob('../public/img/hrd/ga/pengeluaranbarang/bon_' . Str::afterLast($this->no_keluar, '/') . '_*'));
		return $img;
	}
}
