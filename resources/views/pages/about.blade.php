@extends('layouts.app')

@section('title', __('general.about_us') . ' - ' . config('app.name'))

@section('content')
<!-- Breadcrumb Section Start -->
<div class="breadcrumb-wrap bg-f br-1">
    <div class="container">
        <div class="breadcrumb-title">
            <h2>{{ __('general.about_us') }}</h2>
            <ul class="breadcrumb-menu list-style">
                <li><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
                <li>{{ __('menu.about') }}</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- About Section Start -->
<section class="about-section ptb-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="about-img">
                    <img src="{{ asset('assets/img/about/about-1.webp') }}" alt="{{ __('general.about_us') }}">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="about-content">
                    <span class="subtitle">{{ __('general.about_clinic') }}</span>
                    <h2>{{ __('general.quality_dental_care') }}</h2>
                    <p>{{ __('general.about_description_1') }}</p>
                    <p>{{ __('general.about_description_2') }}</p>
                    
                    <ul class="feature-list list-style-two">
                        <li><i class="ri-check-line"></i>{{ __('general.experienced_dentists') }}</li>
                        <li><i class="ri-check-line"></i>{{ __('general.modern_equipment') }}</li>
                        <li><i class="ri-check-line"></i>{{ __('general.comfortable_environment') }}</li>
                        <li><i class="ri-check-line"></i>{{ __('general.affordable_pricing') }}</li>
                        <li><i class="ri-check-line"></i>{{ __('general.emergency_services') }}</li>
                    </ul>

                    <a href="{{ route('appointments.create') }}" class="btn style-one mt-4">{{ __('general.book_appointment') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Section End -->

<!-- Why Choose Us Section Start -->
<section class="why-choose-section bg-grey ptb-100">
    <div class="container">
        <div class="section-title text-center">
            <span class="subtitle">Why Choose Us</span>
            <h2>Reasons To Choose Our Clinic</h2>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6" data-aos="fade-up">
                <div class="feature-card text-center">
                    <i class="flaticon-tooth"></i>
                    <h3>Expert Dentists</h3>
                    <p>Our team consists of highly qualified and experienced dental professionals dedicated to your care.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card text-center">
                    <i class="flaticon-dentist-chair"></i>
                    <h3>Advanced Technology</h3>
                    <p>We use the latest dental equipment and techniques for accurate diagnosis and effective treatment.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card text-center">
                    <i class="flaticon-24-hours"></i>
                    <h3>Emergency Care</h3>
                    <p>We provide emergency dental services to address your urgent dental needs promptly.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Why Choose Us Section End -->

<!-- Team Section Start -->
<section class="team-section ptb-100">
    <div class="container">
        <div class="section-title text-center">
            <span class="subtitle">Our Team</span>
            <h2>Meet Our Expert Dentists</h2>
        </div>
        <div class="row justify-content-center">
            @php
            $doctors = \App\Models\Doctor::where('is_active', true)->orderBy('order')->take(4)->get();
            @endphp
            @foreach($doctors as $doctor)
            <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="team-card">
                    @if($doctor->image)
                    <img src="{{ doctor_image($doctor->image) }}" alt="{{ $doctor->name }}">
                    @else
                    <img src="{{ asset('assets/img/team/team-1.webp') }}" alt="{{ $doctor->name }}">
                    @endif
                    <div class="team-info">
                        <h3><a href="{{ route('doctors.show', $doctor) }}">{{ $doctor->name }}</a></h3>
                        <span>{{ $doctor->specialization }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('doctors.index') }}" class="btn style-one">View All Dentists</a>
        </div>
    </div>
</section>
<!-- Team Section End -->
@endsection
