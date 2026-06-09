<?php

namespace App\driverapp;

use App\User;
use Illuminate\Database\Eloquent\Model;

class JasaMst extends Model
{
  protected $table = 'mst_jasa';

	public function scopeKendaraan($query) {
		return $query->where('jenis', 'kendaraan');
	}
}
