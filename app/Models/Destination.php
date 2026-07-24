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
        'title_card',
        'subtitle_card',
        'text_label_banner',
        'description',
        'departure_location',
        'departure_time',
        'return_time',
        'child_policy',
        'payment_info',
        'urgency_badge',
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

    public function observations()
    {
        return $this->hasMany(DestinationObservation::class)->orderBy('order');
    }

    public function paymentMethods()
    {
        return $this->hasMany(DestinationPaymentMethod::class)->orderBy('order');
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class)->orderBy('order');
    }
}