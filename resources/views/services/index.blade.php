@extends('layouts.app')

@section('title', __('general.our_services') . ' - ' . config('app.name'))

@section('content')
<!-- Breadcrumb Section Start -->
<div class="breadcrumb-wrap bg-f br-1">
    <div class="container">
        <div class="breadcrumb-title">
            <h2>{{ __('general.our_services') }}</h2>
            <ul class="breadcrumb-menu list-style">
                <li><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
                <li>{{ __('menu.services') }}</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Services Section Start -->
<section class="service-section ptb-100">
    <div class="container">
        <div class="section-title text-center">
            <span class="subtitle">{{ __('general.our_services') }}</span>
            <h2>{{ __('general.service_title') }}</h2>
            <p>{{ __('general.service_description') }}</p>
        </div>

        @if($services->count() > 0)
        <div class="row justify-content-center">
            @foreach($services as $service)
            <div class="col-xl-4 col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="service-card style-one">
                    @if($service->image)
                    <div class="service-img">
                        <img src="{{ service_image($service->image) }}" alt="{{ $service->title }}">
                    </div>
                    @endif
                    
                    @if($service->icon)
                    <div class="service-icon">
                        <i class="{{ $service->icon }}"></i>
                    </div>
                    @endif
                    
                    <div class="service-info">
                        <h3><a href="{{ route('services.show', $service) }}">{{ $service->title }}</a></h3>
                        <p>{{ $service->description }}</p>
                        <a href="{{ route('services.show', $service) }}" class="link-one">
                            {{ __('general.read_more') }} <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="pagination-wrap">
                    {{ $services->links() }}
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-12 text-center">
                <p class="lead">No services available at the moment.</p>
            </div>
        </div>
        @endif
    </div>
</section>
<!-- Services Section End -->

<!-- CTA Section Start -->
<section class="cta-section bg-grey ptb-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="cta-content">
                    <h2>Need Dental Care? Book an Appointment Today!</h2>
                    <p>Get professional dental care from our experienced team.</p>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('appointments.create') }}" class="btn style-one">{{ __('general.book_appointment') }}</a>
            </div>
        </div>
    </div>
</section>
<!-- CTA Section End -->
@endsection
