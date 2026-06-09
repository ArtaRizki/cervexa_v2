<?php

namespace App\salesapp;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AppSalesBanners extends Model
{

    protected $table = 'app_sales_banners';
    /**
     * Scope a query to only include
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where(function ($q) {
            $q->whereNotNull('img_mobile')->whereDate('validity_date', '>=', Carbon::now());
        });
    }

    // public function getSeenAttribute()
    // {
    //     $is_seen = AppBannerSeen::where('banner_id', $this->id)->where('user_id', auth()->user()->id)->count();
    //     return $is_seen > 0;
    // }
}
