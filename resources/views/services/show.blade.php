@extends('layouts.app')

@section('title', $service->title . ' - ' . config('app.name'))

@section('content')
<!-- Breadcrumb Section Start -->
<div class="breadcrumb-wrap bg-f br-1">
    <div class="container">
        <div class="breadcrumb-title">
            <h2>{{ $service->title }}</h2>
            <ul class="breadcrumb-menu list-style">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('services.index') }}">Services</a></li>
                <li>{{ $service->title }}</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Service Details Section Start -->
<section class="service-details-section ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="service-details-content">
                    @if($service->image)
                    <div class="service-image mb-4">
                        <img src="{{ service_image($service->image) }}" alt="{{ $service->title }}" class="img-fluid rounded">
                    </div>
                    @endif

                    <h2>{{ $service->title }}</h2>
                    
                    <div class="service-description mt-4">
                        @if($service->full_description)
                        <div>{!! nl2br(e($service->full_description)) !!}</div>
                        @else
                        <p>{{ $service->description }}</p>
                        @endif
                    </div>

                    <!-- Key Benefits -->
                    <div class="service-benefits mt-5">
                        <h3>Why Choose This Service?</h3>
                        <ul class="list-style-two">
                            <li><i class="ri-check-line"></i>Professional and experienced dentists</li>
                            <li><i class="ri-check-line"></i>State-of-the-art equipment</li>
                            <li><i class="ri-check-line"></i>Comfortable and safe environment</li>
                            <li><i class="ri-check-line"></i>Affordable pricing</li>
                            <li><i class="ri-check-line"></i>Personalized treatment plans</li>
                        </ul>
                    </div>

                    <!-- CTA -->
                    <div class="service-cta mt-5 p-4 bg-light rounded">
                        <h4>Ready to Get Started?</h4>
                        <p>Book an appointment today and let us take care of your dental needs.</p>
                        <a href="{{ route('appointments.create') }}" class="btn style-one">{{ __('general.book_appointment') }}</a>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar">
                    <!-- All Services -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">All Services</h3>
                        <ul class="service-list list-style">
                            @foreach($relatedServices as $relatedService)
                            <li>
                                <a href="{{ route('services.show', $relatedService) }}">
                                    <i class="ri-arrow-right-line"></i>{{ $relatedService->title }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Contact Widget -->
                    <div class="sidebar-widget contact-widget">
                        <h3 class="widget-title">Need Help?</h3>
                        <div class="contact-info-widget">
                            <div class="contact-item">
                                <i class="flaticon-phone-call"></i>
                                <h4>Call Us</h4>
                                <a href="tel:{{ setting('phone', '+1234567890') }}">{{ setting('phone', '+1 234 567 890') }}</a>
                            </div>
                            <div class="contact-item">
                                <i class="flaticon-mail"></i>
                                <h4>Email Us</h4>
                                <a href="mailto:{{ setting('contact_email', 'info@clinic.com') }}">{{ setting('contact_email', 'info@clinic.com') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Service Details Section End -->
@endsection
