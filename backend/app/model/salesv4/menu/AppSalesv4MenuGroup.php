<?php

namespace App\model\salesv4\menu;

use Illuminate\Database\Eloquent\Model;

class AppSalesv4MenuGroup extends Model
{
    protected $table = 'app_salesv4_menu_group';
    protected $fillable = [
        'nama',
        'aktif',
    ];
}
