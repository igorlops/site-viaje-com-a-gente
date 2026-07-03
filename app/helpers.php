<?php

use App\Models\SiteSetting;

if (!function_exists('site_setting')) {
    function site_setting(string $key, mixed $default = null)
    {
        try {
            $setting = SiteSetting::where('key', $key)->first();
            if (!$setting) {
                return $default;
            }
            return $setting->value;
        } catch (\Exception $e) {
            return $default;
        }
    }
}

if (!function_exists('site_setting_image')) {
    function site_setting_image(string $key, mixed $default = null)
    {
        $value = site_setting($key);
        if (!$value) {
            return $default ? asset($default) : null;
        }
        if (str_starts_with($value, 'settings/') || str_starts_with($value, 'banners/')) {
            return asset('storage/' . $value);
        }
        return asset($value);
    }
}
