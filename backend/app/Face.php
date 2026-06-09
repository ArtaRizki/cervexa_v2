<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Face extends Model {
	protected $primaryKey = 'record_no';
	protected $connection = 'zkbio';
	protected $table = 'hep_transaction';
}
