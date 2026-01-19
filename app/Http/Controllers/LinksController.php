<?php

namespace App\Http\Controllers;

use App\Models\SocialLink;
use App\Models\Setting;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    public function index()
    {
        $links = SocialLink::active()->ordered()->get();
        
        // Get clinic info from settings
        $clinicName = Setting::where('key', 'site_name')->first()->value ?? 'Our Clinic';
        $clinicLogo = Setting::where('key', 'site_logo')->first()->value ?? null;
        $clinicDescription = Setting::where('key', 'site_description')->first()->value ?? 'Connect with us';
        
        return view('links.index', compact('links', 'clinicName', 'clinicLogo', 'clinicDescription'));
    }
}
