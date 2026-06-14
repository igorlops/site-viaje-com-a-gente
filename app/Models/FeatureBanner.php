<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class FeatureBanner extends Model
{
    protected $table = 'features_banner';
    protected $fillable = ['name', 'icon','order','banner_id'];
}
