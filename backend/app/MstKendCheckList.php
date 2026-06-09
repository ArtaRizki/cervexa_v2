<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\v1\hrd\ga\TrsKendCheckList;
class MstKendCheckList extends Model {

	protected $table = 'mst_kendaraan_checklist';
	protected $fillable = ['nama', 'aktif', 'user_id', 'kend_jenis',];
	public function trs() {
		return $this->hasOne(TrsKendCheckList::class, 'check_id', 'id');
	}
}
