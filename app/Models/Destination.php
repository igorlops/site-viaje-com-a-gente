<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'subtitle', 'image_path', 'duration', 'category', 'price', 'tag', 'is_featured', 'whatsapp_link'])]
class Destination extends Model
{
    //
}
