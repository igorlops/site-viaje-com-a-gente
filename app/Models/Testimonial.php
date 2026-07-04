<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_name',
        'author_role',
        'author_photo',
        'content',
        'rating',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'rating'    => 'integer',
        'order'     => 'integer',
    ];

    /**
     * Scope: apenas depoimentos ativos, ordenados.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}
