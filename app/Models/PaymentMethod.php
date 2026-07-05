<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'icon_color',
    ];

    public function destinationPayments()
    {
        return $this->hasMany(DestinationPaymentMethod::class);
    }
}
