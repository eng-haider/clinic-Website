<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'patient_name',
        'patient_title',
        'content',
        'rating',
        'image',
        'is_active',
        'order',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($testimonial) {
            // Strip directory path from image, keep only filename
            if ($testimonial->image && str_contains($testimonial->image, '/')) {
                $testimonial->image = basename($testimonial->image);
            }
        });
    }
}
