<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switch(Request $request)
    {
        $locale = $request->input('locale', 'ar');
        
        // Validate locale
        if (!in_array($locale, ['ar', 'en'])) {
            $locale = 'ar';
        }
        
        // Store locale in session
        Session::put('locale', $locale);
        
        // Redirect back to previous page
        return redirect()->back();
    }
}
