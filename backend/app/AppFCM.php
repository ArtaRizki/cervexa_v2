<?php

namespace App;

use App\VUser;
use Illuminate\Database\Eloquent\Model;

class AppFCM extends Model {
	protected $table = 'app_myirs_fcm';
	protected $guarded = ['id'];

	public function user() {
		return $this->hasOne(VUser::class, 'id', 'karyawan_id');
	}

	public function scopeUserToken($query, $token) {
		return $query->where('token', $token);
	}
}
