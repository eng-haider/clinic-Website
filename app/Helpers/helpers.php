<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

if (!function_exists('setting')) {
    /**
     * Get setting value by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function setting(string $key, $default = null)
    {
        return Cache::remember("setting_{$key}", 3600, function () use ($key, $default) {
            $setting = Setting::where('key', $key)->first();
            
            if (!$setting) {
                return $default;
            }
            
            // If it's an image type setting, return the full URL
            if ($setting->type === 'image' && $setting->value) {
                // Check if it's already a full URL or an asset path
                if (str_starts_with($setting->value, 'http://') || str_starts_with($setting->value, 'https://')) {
                    return $setting->value;
                }
                
                // If it starts with 'assets/', treat it as a public asset
                if (str_starts_with($setting->value, 'assets/')) {
                    return asset($setting->value);
                }
                
                // Otherwise, it's a storage file
                return asset('storage/' . $setting->value);
            }
            
            return $setting->value;
        });
    }
}

