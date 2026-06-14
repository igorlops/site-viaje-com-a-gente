<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'summary',
        'content',
        'banner_path',
        'image_path',
        'status',
        'show_in_menu',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
    ];

    protected $casts = [
        'show_in_menu' => 'boolean',
    ];

    /**
     * Escopo para serviços publicados.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Escopo para serviços que aparecem no menu.
     */
    public function scopeInMenu($query)
    {
        return $query->where('show_in_menu', true)->where('status', 'published');
    }

    /**
     * Gera slug automático a partir do título.
     */
    public static function generateSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $count = 1;

        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $original . '-' . $count++;
        }

        return $slug;
    }

    /**
     * Verifica se o serviço está publicado.
     */
    public function isPublished(): bool
    {
        return $this->status === 'published';
    }
}
