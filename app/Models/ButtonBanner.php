<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class ButtonBanner extends Model
{
    protected $table = 'buttons_banner';
    protected $fillable = ['text', 'color','url','target','order','banner_id'];
}
