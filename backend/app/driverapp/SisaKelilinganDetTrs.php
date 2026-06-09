<?php

namespace App\model\driverapp;

use Illuminate\Database\Eloquent\Model;

class SisaKelilinganDetTrs extends Model
{
  protected $table = 'trs_sisa_kelilingan_det';
  protected $fillable = ['header_id', "user_id", 'idprod', 'kodeprod', 'expdate', 'jmlpeti', 'jmlsatu', 'created_at', 'updated_at', 'note'];
}
