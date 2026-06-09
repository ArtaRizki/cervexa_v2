<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrsGudangMst extends Model {
	protected $table = "mst_trs_gudang";
	public function akses() {
		return $this->hasMany(JenisTransTrs::class, 'jenis_id', 'id');
	}

	/**
	 * Scope a query to only include
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeOut($query) {
		return $query->where('jenis', 'out');
	}
}
