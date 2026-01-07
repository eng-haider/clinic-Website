<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    /**
     * Display all bookings in dashboard
     */
    public function index()
    {
        $bookings = Booking::orderBy('created_at', 'desc')
            ->paginate(20);

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Store a new booking
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_phone' => 'required|string|min:10',
            'booking_date' => 'required|date|after_or_equal:today',
            'patient_code' => 'nullable|string',
            'patient_name' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $booking = Booking::create([
            'patient_phone' => $request->patient_phone,
            'booking_date' => $request->booking_date,
            'patient_code' => $request->patient_code,
            'patient_name' => $request->patient_name,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Booking created successfully',
                'booking' => $booking
            ], 201);
        }

        return redirect()->back()->with('success', 'Booking created successfully! We will contact you soon.');
    }

    /**
     * Update booking status
     */
    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $booking->update($validated);

        return redirect()->back()->with('success', 'Booking status updated successfully!');
    }

    /**
     * Delete a booking
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->back()->with('success', 'Booking deleted successfully!');
    }
}
