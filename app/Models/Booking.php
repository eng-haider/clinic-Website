<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'booking_date' => 'date',
        ];
    }
    
    /**
     * Get the booking date as a formatted string, handling invalid dates
     */
    public function getFormattedBookingDateAttribute()
    {
        try {
            return $this->booking_date ? $this->booking_date->format('Y-m-d') : 'Invalid Date';
        } catch (\Exception $e) {
            return 'Invalid Date';
        }
    }
}
