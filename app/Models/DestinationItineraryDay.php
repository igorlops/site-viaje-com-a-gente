<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationItineraryDay extends Model
{
    use HasFactory;

    protected $fillable = ['destination_id', 'day_number', 'date', 'label', 'order'];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function activities()
    {
        return $this->hasMany(DestinationItineraryActivity::class, 'itinerary_day_id')->orderBy('order');
    }
}