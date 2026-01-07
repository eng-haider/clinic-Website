@extends('layouts.app')

@section('title', $doctor->name . ' - ' . config('app.name'))

@section('content')
<!-- Breadcrumb Section Start -->
<div class="breadcrumb-wrap bg-f br-1">
    <div class="container">
        <div class="breadcrumb-title">
            <h2>{{ $doctor->name }}</h2>
            <ul class="breadcrumb-menu list-style">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('doctors.index') }}">Dentists</a></li>
                <li>{{ $doctor->name }}</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Doctor Details Section Start -->
<section class="team-details-section ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="team-details-sidebar">
                    <div class="team-img">
                        @if($doctor->image)
                        <img src="{{ doctor_image($doctor->image) }}" alt="{{ $doctor->name }}" class="img-fluid rounded">
                        @else
                        <img src="{{ asset('assets/img/team/team-1.webp') }}" alt="{{ $doctor->name }}" class="img-fluid rounded">
                        @endif
                    </div>

                    <div class="team-info-widget mt-4">
                        <h3>{{ $doctor->name }}</h3>
                        <span class="designation">{{ $doctor->specialization }}</span>
                        
                        @if($doctor->degree)
                        <p class="degree"><strong>Degree:</strong> {{ $doctor->degree }}</p>
                        @endif

                        @if($doctor->experience_years > 0)
                        <p class="experience"><strong>Experience:</strong> {{ $doctor->experience_years }}+ Years</p>
                        @endif

                        @if($doctor->email)
                        <div class="contact-info">
                            <i class="flaticon-mail"></i>
                            <h5>Email</h5>
                            <a href="mailto:{{ $doctor->email }}">{{ $doctor->email }}</a>
                        </div>
                        @endif

                        @if($doctor->phone)
                        <div class="contact-info">
                            <i class="flaticon-phone-call"></i>
                            <h5>Phone</h5>
                            <a href="tel:{{ $doctor->phone }}">{{ $doctor->phone }}</a>
                        </div>
                        @endif

                        @if($doctor->social_links)
                        <ul class="social-profile list-style mt-4">
                            @if(isset($doctor->social_links['facebook']))
                            <li><a href="{{ $doctor->social_links['facebook'] }}" target="_blank"><i class="ri-facebook-fill"></i></a></li>
                            @endif
                            @if(isset($doctor->social_links['twitter']))
                            <li><a href="{{ $doctor->social_links['twitter'] }}" target="_blank"><i class="ri-twitter-fill"></i></a></li>
                            @endif
                            @if(isset($doctor->social_links['linkedin']))
                            <li><a href="{{ $doctor->social_links['linkedin'] }}" target="_blank"><i class="ri-linkedin-fill"></i></a></li>
                            @endif
                            @if(isset($doctor->social_links['instagram']))
                            <li><a href="{{ $doctor->social_links['instagram'] }}" target="_blank"><i class="ri-instagram-line"></i></a></li>
                            @endif
                        </ul>
                        @endif

                        <div class="mt-4">
                            <a href="{{ route('appointments.create') }}" class="btn style-one w-100">{{ __('general.book_appointment') }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="team-details-content">
                    <h2>About {{ $doctor->name }}</h2>
                    
                    @if($doctor->bio)
                    <div class="bio-content mt-4">
                        {!! nl2br(e($doctor->bio)) !!}
                    </div>
                    @else
                    <p>{{ $doctor->name }} is a highly qualified {{ $doctor->specialization }} with {{ $doctor->experience_years }}+ years of experience in dental care.</p>
                    @endif

                    <div class="expertise-section mt-5">
                        <h3>Areas of Expertise</h3>
                        <ul class="list-style-two">
                            <li><i class="ri-check-line"></i>{{ $doctor->specialization }}</li>
                            <li><i class="ri-check-line"></i>Advanced Dental Treatments</li>
                            <li><i class="ri-check-line"></i>Patient Care & Consultation</li>
                            <li><i class="ri-check-line"></i>Cosmetic Dentistry</li>
                            <li><i class="ri-check-line"></i>Preventive Dental Care</li>
                        </ul>
                    </div>

                    <div class="education-section mt-5">
                        <h3>Education & Qualifications</h3>
                        @if($doctor->degree)
                        <p><strong>{{ $doctor->degree }}</strong></p>
                        @endif
                        <ul class="list-style-two">
                            <li><i class="ri-check-line"></i>Licensed Dental Professional</li>
                            <li><i class="ri-check-line"></i>{{ $doctor->experience_years }}+ Years Clinical Experience</li>
                            <li><i class="ri-check-line"></i>Continuous Professional Development</li>
                        </ul>
                    </div>

                    <div class="appointment-cta mt-5 p-4 bg-light rounded">
                        <h4>Book an Appointment with {{ $doctor->name }}</h4>
                        <p>Schedule your consultation today and get personalized dental care from our experienced professional.</p>
                        <a href="{{ route('appointments.create') }}" class="btn style-one">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Doctor Details Section End -->
@endsection
