<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'patient_code',
        'patient_name',
        'patient_phone',
        'booking_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'booking_date' => 'date',
    ];
}
