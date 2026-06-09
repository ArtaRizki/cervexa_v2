<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppMenus extends Model {
	protected $table = 'app_myirs_menu';
	public function user() {
		$data = $this->hasOneThrough(VUser::class, MenuAkses::class, 'menu_id', 'id', 'id', 'karyawan_id');
		return $data;
	}
}
