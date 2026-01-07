@extends('layouts.app')

@section('title', 'Book Appointment - ' . config('app.name'))

@section('content')
<!-- Breadcrumb Section Start -->
<div class="breadcrumb-wrap bg-f br-1">
    <div class="container">
        <div class="breadcrumb-title">
            <h2>Book Appointment</h2>
            <ul class="breadcrumb-menu list-style">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Book Appointment</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Appointment Section Start -->
<section class="appointment-section ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="section-title text-center mb-5">
                    <span class="subtitle">Schedule Your Visit</span>
                    <h2>Book an Appointment</h2>
                    <p>Fill out the form below to schedule your appointment with our expert dentists.</p>
                </div>

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="ri-check-line"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="appointment-form-wrap">
                    <form action="{{ route('appointments.store') }}" method="POST" class="appointment-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="patient_name">{{ __('general.full_name') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('patient_name') is-invalid @enderror" 
                                           id="patient_name" name="patient_name" value="{{ old('patient_name') }}" 
                                           placeholder="{{ __('general.enter_full_name') }}" required>
                                    @error('patient_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">{{ __('general.email_address') }} <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email') }}" 
                                           placeholder="{{ __('general.enter_your_email') }}" required>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">{{ __('general.phone_number') }} <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone') }}" 
                                           placeholder="{{ __('general.enter_phone_number') }}" required>
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="doctor_id">{{ __('general.select_doctor') }}</label>
                                    <select class="form-control @error('doctor_id') is-invalid @enderror" 
                                            id="doctor_id" name="doctor_id">
                                        <option value="">Any Available Dentist</option>
                                        @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                            {{ $doctor->name }} - {{ $doctor->specialization }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('doctor_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="appointment_date">Preferred Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('appointment_date') is-invalid @enderror" 
                                           id="appointment_date" name="appointment_date" value="{{ old('appointment_date') }}" 
                                           min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                                    @error('appointment_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="appointment_time">Preferred Time <span class="text-danger">*</span></label>
                                    <select class="form-control @error('appointment_time') is-invalid @enderror" 
                                            id="appointment_time" name="appointment_time" required>
                                        <option value="">Select Time</option>
                                        <option value="09:00" {{ old('appointment_time') == '09:00' ? 'selected' : '' }}>09:00 AM</option>
                                        <option value="10:00" {{ old('appointment_time') == '10:00' ? 'selected' : '' }}>10:00 AM</option>
                                        <option value="11:00" {{ old('appointment_time') == '11:00' ? 'selected' : '' }}>11:00 AM</option>
                                        <option value="12:00" {{ old('appointment_time') == '12:00' ? 'selected' : '' }}>12:00 PM</option>
                                        <option value="14:00" {{ old('appointment_time') == '14:00' ? 'selected' : '' }}>02:00 PM</option>
                                        <option value="15:00" {{ old('appointment_time') == '15:00' ? 'selected' : '' }}>03:00 PM</option>
                                        <option value="16:00" {{ old('appointment_time') == '16:00' ? 'selected' : '' }}>04:00 PM</option>
                                        <option value="17:00" {{ old('appointment_time') == '17:00' ? 'selected' : '' }}>05:00 PM</option>
                                    </select>
                                    @error('appointment_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="message">{{ __('general.additional_message') }}</label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" 
                                              id="message" name="message" rows="4" 
                                              placeholder="{{ __('general.dental_concern_message') }}">{{ old('message') }}</textarea>
                                    @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn style-one w-100">
                                    <i class="ri-calendar-check-line"></i> Submit Appointment Request
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Appointment Section End -->

<!-- Info Section Start -->
<section class="info-section bg-grey ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="info-card text-center">
                    <i class="flaticon-phone-call"></i>
                    <h3>Call Us</h3>
                    <p>For urgent appointments, call us directly</p>
                    <a href="tel:{{ setting('phone', '+1234567890') }}">{{ setting('phone', '+1 234 567 890') }}</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="info-card text-center">
                    <i class="flaticon-mail"></i>
                    <h3>Email Us</h3>
                    <p>Send us your queries anytime</p>
                    <a href="mailto:{{ setting('contact_email', 'info@clinic.com') }}">{{ setting('contact_email', 'info@clinic.com') }}</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="info-card text-center">
                    <i class="flaticon-clock"></i>
                    <h3>Working Hours</h3>
                    <p>{{ setting('working_hours', 'Mon - Sat: 09.00 to 18.00') }}</p>
                    <p>Sunday: Closed</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Info Section End -->
@endsection
