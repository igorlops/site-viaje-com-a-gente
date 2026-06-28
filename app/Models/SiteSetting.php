<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value', 'type', 'label', 'group', 'order'];

    /**
     * Retorna o valor de uma configuração pelo key.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = static::where('key', $key)->first();
        return $setting?->value ?? $default;
    }

    /**
     * Define/atualiza o valor de uma configuração pelo key.
     */
    public static function set(string $key, mixed $value): void
    {
        static::where('key', $key)->update(['value' => $value]);
    }

    /**
     * Retorna todas as configurações agrupadas por 'group'.
     */
    public static function allGrouped(): \Illuminate\Support\Collection
    {
        return static::orderBy('group')->orderBy('order')->get()->groupBy('group');
    }
}
