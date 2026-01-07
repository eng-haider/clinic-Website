<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function create()
    {
        $doctors = Doctor::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('appointments.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'doctor_id' => 'nullable|exists:doctors,id',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required',
            'message' => 'nullable|string',
        ]);

        $validated['status'] = 'pending';

        Appointment::create($validated);

        return redirect()->route('appointments.create')->with('success', 'Your appointment request has been submitted successfully! We will contact you soon.');
    }
}
