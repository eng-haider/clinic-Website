<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::where('is_active', true)
            ->orderBy('order')
            ->paginate(12);

        return view('doctors.index', compact('doctors'));
    }

    public function show(Doctor $doctor)
    {
        if (!$doctor->is_active) {
            abort(404);
        }

        return view('doctors.show', compact('doctor'));
    }
}
