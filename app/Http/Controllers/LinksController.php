<?php

namespace App\Http\Controllers;

use App\Models\SocialLink;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    public function index()
    {
        $links = SocialLink::active()->ordered()->get();
        
        // Get clinic info from settings using the setting() helper
        $clinicName = setting('clinic_name', 'Our Clinic');
        $clinicLogo = setting('site_logo'); // The helper handles the full URL
        $clinicDescription = setting('site_description', 'Connect with us');
        
        return view('links.index', compact('links', 'clinicName', 'clinicLogo', 'clinicDescription'));
    }
}
