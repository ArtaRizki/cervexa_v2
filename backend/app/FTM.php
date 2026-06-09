<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FTM extends Model {
  protected $primaryKey = 'att_id';
  protected $connection = 'ftm';
  protected $table = 'att_log';
}
