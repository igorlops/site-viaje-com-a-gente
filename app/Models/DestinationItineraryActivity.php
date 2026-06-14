<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationItineraryActivity extends Model
{
    use HasFactory;

    protected $fillable = ['itinerary_day_id', 'activity', 'order'];

    public function itineraryDay()
    {
        return $this->belongsTo(DestinationItineraryDay::class, 'itinerary_day_id');
    }
}