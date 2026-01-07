@extends('layouts.app')

@section('title', __('general.contact_us') . ' - ' . config('app.name'))

@section('content')
<!-- Breadcrumb Section Start -->
<div class="breadcrumb-wrap bg-f br-1">
    <div class="container">
        <div class="breadcrumb-title">
            <h2>{{ __('general.contact_us') }}</h2>
            <ul class="breadcrumb-menu list-style">
                <li><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
                <li>{{ __('menu.contact') }}</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Contact Section Start -->
<section class="contact-section ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="contact-form-wrap">
                    <div class="section-title mb-4">
                        <h2>{{ __('general.get_in_touch') }}</h2>
                        <p>{{ __('general.contact_message') }}</p>
                    </div>

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="ri-check-line"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ __('general.your_name') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name') }}" 
                                           placeholder="{{ __('general.enter_your_name') }}" required>
                                    @error('name')
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
                                    <label for="phone">{{ __('general.phone_number') }}</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone') }}" 
                                           placeholder="{{ __('general.enter_phone_number') }}">
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subject">{{ __('general.subject') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                                           id="subject" name="subject" value="{{ old('subject') }}" 
                                           placeholder="{{ __('general.enter_subject') }}" required>
                                    @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="message">{{ __('general.your_message') }} <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" 
                                              id="message" name="message" rows="6" 
                                              placeholder="{{ __('general.write_message') }}" required>{{ old('message') }}</textarea>
                                    @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn style-one">
                                    <i class="ri-send-plane-line"></i> {{ __('general.send_message') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="contact-info-wrap">
                    <h3>{{ __('general.contact_info') }}</h3>
                    
                    <div class="contact-item">
                        <i class="flaticon-pin"></i>
                        <div class="contact-details">
                            <h4>{{ __('general.address') }}</h4>
                            <p>{{ setting('address', '86 Brattle Street Cambridge, MA 0138, USA') }}</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <i class="flaticon-phone-call"></i>
                        <div class="contact-details">
                            <h4>Phone</h4>
                            <a href="tel:{{ setting('phone', '+1234567890') }}">{{ setting('phone', '+1 234 567 890') }}</a>
                        </div>
                    </div>

                    <div class="contact-item">
                        <i class="flaticon-mail"></i>
                        <div class="contact-details">
                            <h4>Email</h4>
                            <a href="mailto:{{ setting('contact_email', 'info@clinic.com') }}">{{ setting('contact_email', 'info@clinic.com') }}</a>
                        </div>
                    </div>

                    <div class="contact-item">
                        <i class="flaticon-clock"></i>
                        <div class="contact-details">
                            <h4>Working Hours</h4>
                            <p>Mon - Fri: {{ setting('hours_mon_thu', '9:00 AM - 7:00 PM') }}</p>
                            <p>Saturday: {{ setting('hours_sat', '9:00 AM - 5:00 PM') }}</p>
                            <p>Sunday: {{ setting('hours_sun', 'Closed') }}</p>
                        </div>
                    </div>

                    <div class="social-links mt-4">
                        <h4>Follow Us</h4>
                        <ul class="social-profile list-style">
                            @if(setting('facebook_url'))
                            <li><a href="{{ setting('facebook_url') }}" target="_blank"><i class="ri-facebook-fill"></i></a></li>
                            @endif
                            @if(setting('twitter_url'))
                            <li><a href="{{ setting('twitter_url') }}" target="_blank"><i class="ri-twitter-fill"></i></a></li>
                            @endif
                            @if(setting('instagram_url'))
                            <li><a href="{{ setting('instagram_url') }}" target="_blank"><i class="ri-instagram-line"></i></a></li>
                            @endif
                            @if(setting('linkedin_url'))
                            <li><a href="{{ setting('linkedin_url') }}" target="_blank"><i class="ri-linkedin-fill"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

<!-- Map Section (Optional) -->
<section class="map-section">
    <div class="container-fluid p-0">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3023.9503481784375!2d-73.9856018!3d40.7589185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258fbaeffffff%3A0x5c4ff2b7c8b24!2sTimes%20Square!5e0!3m2!1sen!2sus!4v1234567890" 
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</section>
@endsection
