<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationObservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_id',
        'text',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    /**
     * Relacionamento: pertence a um destino.
     */
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
