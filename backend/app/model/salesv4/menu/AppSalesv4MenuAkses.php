<?php

namespace App\model\salesv4\menu;

use App\VUser;

use Illuminate\Database\Eloquent\Model;

class AppSalesv4MenuAkses extends Model
{
    protected $table = 'app_salesv4_menu_akses';
    protected $fillable = [
        'user_id',
        'menu_id',
        'created_id',
    ];
}
