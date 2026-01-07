<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'icon',
        'description',
        'full_description',
        'image',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($service) {
            // Strip directory path from image, keep only filename
            if ($service->image && str_contains($service->image, '/')) {
                $service->image = basename($service->image);
            }
        });
    }
}
