<?php

namespace App\model\driverapp;

use App\VUser;
use Illuminate\Database\Eloquent\Model;

class PrinterSettingMst extends Model
{
  protected $table = 'mst_print_setting';
  protected $fillable = [
    'type',
    'size',
    'align',
    'user_id',
  ];

  public function user()
  {
    return $this->hasOne(VUser::class, 'id', 'user_id');
  }
}
