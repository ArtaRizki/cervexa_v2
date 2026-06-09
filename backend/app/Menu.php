<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {
	protected $table = 'app_myirs_menu';
	protected $appends = ['img'];

	public function getImgAttribute() {
		$res = array_map(function ($res) {
			return array(
				'url' => url('img/menu/' . basename($res)),
				'name' => basename($res),
			);
		}, glob('../public/img/menu/' . $this->slug . '.{png,jpeg,jpg,gif,ico}', GLOB_BRACE));
		return $res[0] ?? null;
	}

	public function users() {
		// return 'a';
		// $data = $this->hasMany(MenuAkses::class, 'karyawan_id', 'id');
		$data = $this->hasManyThrough(VUser::class, MenuAkses::class, 'menu_id', 'id', 'id', 'karyawan_id');
		return $data;
	}

	public function user() {
		// return 'a';
		// $data = $this->hasMany(MenuAkses::class, 'karyawan_id', 'id');
		$data = $this->hasOneThrough(VUser::class, MenuAkses::class, 'menu_id', 'id', 'id', 'karyawan_id');
		return $data;
	}
}
