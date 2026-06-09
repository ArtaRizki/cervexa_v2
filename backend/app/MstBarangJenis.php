<?php

namespace App;

use App\v1\ppic\PermintaanBrg;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MstBarangJenis extends Model {
  protected $table = 'mst_jenis_barang';
  protected $guarded = [];
}
