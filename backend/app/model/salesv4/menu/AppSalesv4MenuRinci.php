<?php

namespace App\model\salesv4\menu;

use Illuminate\Database\Eloquent\Model;

class AppSalesv4MenuRinci extends Model
{
    protected $table = 'app_salesv4_menu_rinci';
    protected $fillable = [
        'judul',
        'deskripsi',
        'slug',
        'aktif',
        'group',
    ];

    public function rinci()
    {
        return $this->hasMany(AppSalesv4MenuRinci::class, 'group', 'group');
    }
}
