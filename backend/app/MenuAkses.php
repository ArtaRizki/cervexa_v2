<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuAkses extends Model {
	protected $table = 'app_myirs_menu_akses';

	public function menu() {
		$data = $this->hasOne(Menu::class, 'id', 'menu_id')->where('aktif', 1);
		return $data;
	}
}
