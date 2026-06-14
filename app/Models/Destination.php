<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'image_path',
        'duration',
        'category',
        'price',
        'tag',
        'is_featured',
        'whatsapp_link',
        'slug',
        'banner_image_path',
        'full_price',
        'date_range',
        'nights',
        'departure_date',
        'return_date',
        'departure_city',
        'trip_type',
        'highlights_icons',
        'type',
    ];

    protected $casts = [
        'highlights_icons' => 'array',
        'is_featured' => 'boolean',
    ];

    public function includes()
    {
        return $this->hasMany(DestinationInclude::class)->orderBy('order');
    }

    public function highlights()
    {
        return $this->hasMany(DestinationHighlight::class)->orderBy('order');
    }

    public function itineraryDays()
    {
        return $this->hasMany(DestinationItineraryDay::class)->orderBy('order');
    }
}