<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['title', 'subtitle', 'image_path', 'active', 'page_id', 'titulo_destaque'];
    //
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
    public function buttons()
    {
        return $this->hasMany(ButtonBanner::class);
    }

    public function featureBanners()
    {
        return $this->hasMany(FeatureBanner::class);
    }
}
