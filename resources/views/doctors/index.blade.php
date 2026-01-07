@extends('layouts.app')

@section('title', 'Our Dentists - ' . config('app.name'))

@section('content')
<!-- Breadcrumb Section Start -->
<div class="breadcrumb-wrap bg-f br-1">
    <div class="container">
        <div class="breadcrumb-title">
            <h2>Our Dentists</h2>
            <ul class="breadcrumb-menu list-style">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Dentists</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Dentists Section Start -->
<section class="team-section ptb-100">
    <div class="container">
        <div class="section-title text-center">
            <span class="subtitle">Our Expert Team</span>
            <h2>Meet Our Professional Dentists</h2>
            <p>Our experienced team of dental professionals is dedicated to providing you with the best care possible.</p>
        </div>

        @if($doctors->count() > 0)
        <div class="row justify-content-center">
            @foreach($doctors as $doctor)
            <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="team-card style-one">
                    <div class="team-img">
                        @if($doctor->image)
                        <img src="{{ doctor_image($doctor->image) }}" alt="{{ $doctor->name }}">
                        @else
                        <img src="{{ asset('assets/img/team/team-1.webp') }}" alt="{{ $doctor->name }}">
                        @endif
                        
                        @if($doctor->social_links)
                        <ul class="social-profile list-style">
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
                    </div>
                    <div class="team-info">
                        <h3><a href="{{ route('doctors.show', $doctor) }}">{{ $doctor->name }}</a></h3>
                        <span>{{ $doctor->specialization }}</span>
                        @if($doctor->degree)
                        <p class="degree">{{ $doctor->degree }}</p>
                        @endif
                        @if($doctor->experience_years > 0)
                        <p class="experience">{{ $doctor->experience_years }}+ Years Experience</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="pagination-wrap">
                    {{ $doctors->links() }}
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-12 text-center">
                <p class="lead">No dentists available at the moment.</p>
            </div>
        </div>
        @endif
    </div>
</section>
<!-- Dentists Section End -->

<!-- CTA Section Start -->
<section class="cta-section bg-grey ptb-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="cta-content">
                    <h2>Schedule Your Appointment Today</h2>
                    <p>Our expert dentists are ready to help you achieve a healthy, beautiful smile.</p>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('appointments.create') }}" class="btn style-one">Book Appointment</a>
            </div>
        </div>
    </div>
</section>
<!-- CTA Section End -->
@endsection
