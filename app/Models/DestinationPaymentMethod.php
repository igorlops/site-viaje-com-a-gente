<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationPaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_id',
        'payment_method_id',
        'text',
        'subtext',
        'order',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }
}
