@extends('layouts.app')

@section('title', 'Testimonials - ' . config('app.name'))

@section('content')
<!-- Breadcrumb Section Start -->
<div class="breadcrumb-wrap bg-f br-1">
    <div class="container">
        <div class="breadcrumb-title">
            <h2>Patient Testimonials</h2>
            <ul class="breadcrumb-menu list-style">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Testimonials</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Testimonials Section Start -->
<section class="testimonial-section ptb-100">
    <div class="container">
        <div class="section-title text-center">
            <span class="subtitle">What Our Patients Say</span>
            <h2>Testimonials From Our Happy Patients</h2>
            <p>Read what our satisfied patients have to say about their experience at our clinic.</p>
        </div>

        @if($testimonials->count() > 0)
        <div class="row justify-content-center">
            @foreach($testimonials as $testimonial)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="testimonial-card style-one">
                    <div class="rating mb-3">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $testimonial->rating)
                            <i class="ri-star-fill"></i>
                            @else
                            <i class="ri-star-line"></i>
                            @endif
                        @endfor
                    </div>
                    
                    <p class="testimonial-text">"{{ $testimonial->content }}"</p>
                    
                    <div class="client-info mt-4">
                        <div class="d-flex align-items-center mb-3">
                            @if($testimonial->image)
                            <img src="{{ client_image($testimonial->image) }}" alt="{{ $testimonial->patient_name }}" class="rounded-circle me-3" width="60" height="60">
                            @endif
                            <div class="client-avatar me-3">
                                <span>{{ substr($testimonial->patient_name, 0, 1) }}</span>
                            </div>
                            @endif
                            <div>
                                <h4>{{ $testimonial->patient_name }}</h4>
                                @if($testimonial->patient_title)
                                <span class="designation">{{ $testimonial->patient_title }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="pagination-wrap">
                    {{ $testimonials->links() }}
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-12 text-center">
                <p class="lead">No testimonials available at the moment.</p>
            </div>
        </div>
        @endif
    </div>
</section>
<!-- Testimonials Section End -->

<!-- CTA Section Start -->
<section class="cta-section bg-grey ptb-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="cta-content">
                    <h2>Ready to Experience Quality Dental Care?</h2>
                    <p>Join our happy patients and schedule your appointment today!</p>
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

@push('styles')
<style>
.client-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    font-weight: bold;
    color: white;
}
</style>
@endpush
