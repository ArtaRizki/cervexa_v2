<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TrsGudangStok extends Model {
	// protected $table = 'trs_gudang_stok';
	protected $table = 'trs_produk_opname';
	protected $guarded = [];
	public function user() {
		return $this->hasOne(VUser::class, 'id', 'user_id');
	}
	public function produk() {
		return $this->hasOne(MstProduk::class, 'idprod', 'idprod');
		// return MstProduk::Where(DB::raw("TRIM(idprod)"), $this->idprod)->get();
	}
}
