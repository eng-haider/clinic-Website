<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Doctor;
use App\Models\Testimonial;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)
            ->orderBy('order')
            ->take(6)
            ->get();
            
        $doctors = Doctor::where('is_active', true)
            ->orderBy('order')
            ->take(4)
            ->get();
            
        $testimonials = Testimonial::where('is_active', true)
            ->orderBy('order')
            ->take(5)
            ->get();
            
        $posts = Post::where('is_published', true)
            ->latest('published_at')
            ->take(3)
            ->get();
            
        return view('home', compact('services', 'doctors', 'testimonials', 'posts'));
    }
}

