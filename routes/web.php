<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PatientLookupController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ToothDiagramProxyController;
use App\Http\Controllers\LinksController;

// Language Switcher
Route::post('/language/switch', [LanguageController::class, 'switch'])->name('language.switch');

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Services
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');

// Doctors
Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
Route::get('/doctors/{doctor}', [DoctorController::class, 'show'])->name('doctors.show');

// Appointments
Route::get('/book-appointment', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/book-appointment', [AppointmentController::class, 'store'])->name('appointments.store');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post}', [BlogController::class, 'show'])->name('blog.show');

// Pages
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/testimonials', [PageController::class, 'testimonials'])->name('testimonials');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/search', [PageController::class, 'search'])->name('search');

// Patient Lookup
Route::get('/patient-system', [PatientLookupController::class, 'home'])->name('patient.system.home');
Route::get('/patient-lookup', [PatientLookupController::class, 'index'])->name('patient.lookup');
Route::get('/qr-generator', [PatientLookupController::class, 'qrGenerator'])->name('qr.generator');
Route::post('/api/patient/lookup', [PatientLookupController::class, 'lookup'])->name('api.patient.lookup');

// Tooth Diagram Proxy (to bypass X-Frame-Options)
Route::get('/tooth-diagram/{patientCode}', [ToothDiagramProxyController::class, 'show'])->name('tooth.diagram.proxy');

// Bookings
Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::patch('/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.updateStatus');
Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');

// Contact Form
Route::post('/contact-message', [ContactController::class, 'store'])->name('contact.message.store');

// Links (Link in Bio page)
Route::get('/links', [LinksController::class, 'index'])->name('links.index');
