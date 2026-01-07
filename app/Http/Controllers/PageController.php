<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Here you can send email or save to database
        // For now, just redirect with success message

        return redirect()->route('contact')->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }

    public function testimonials()
    {
        $testimonials = Testimonial::where('is_active', true)
            ->orderBy('order')
            ->paginate(12);

        return view('pages.testimonials', compact('testimonials'));
    }

    public function faq()
    {
        return view('pages.faq');
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        
        // You can implement search across multiple models here
        
        return view('pages.search', compact('query'));
    }
}
