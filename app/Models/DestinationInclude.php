<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationInclude extends Model
{
    use HasFactory;

    protected $fillable = ['destination_id', 'text', 'type', 'order'];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}