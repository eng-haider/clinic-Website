<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PatientLookupController extends Controller
{
    /**
     * Display the home page for patient system
     */
    public function home()
    {
        return view('patient-system-home');
    }

    /**
     * Display the patient lookup page
     */
    public function index()
    {
        return view('patient-lookup');
    }

    /**
     * Display the QR generator page
     */
    public function qrGenerator()
    {
        return view('qr-generator');
    }

    /**
     * Lookup patient data from external API
     */
    public function lookup(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'phone_number' => 'nullable|string'
        ]);

        try {
            // Prepare request data
            $requestData = [
                'code' => $request->code
            ];
            
            // Add phone_number if provided
            if ($request->filled('phone_number')) {
                $requestData['phone_number'] = $request->phone_number;
            }
            
            // Call external API
            $response = Http::post('https://smartclinicv5.tctate.com/api/public/patient/lookup', $requestData);

            // Return the response as JSON
            return response()->json($response->json());

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء جلب البيانات: ' . $e->getMessage()
            ], 500);
        }
    }
}
