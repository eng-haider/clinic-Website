<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name',
        'specialization',
        'degree',
        'bio',
        'image',
        'email',
        'phone',
        'social_links',
        'experience_years',
        'is_active',
        'order',
    ];

    protected $casts = [
        'social_links' => 'array',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($doctor) {
            // Strip directory path from image, keep only filename
            if ($doctor->image && str_contains($doctor->image, '/')) {
                $doctor->image = basename($doctor->image);
            }
        });
    }
}
