<!-- Footer Start -->
<footer class="footer-wrap style-one">
    <div class="footer-top pb-70">
        <img src="{{ asset('assets/img/footer-shape.webp') }}" alt="Image" class="footer-shape" />
        <div class="container">
            <div class="row">
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-12 col-sm-6">
                    <div class="footer-widget">
                        <a href="{{ url('/') }}" class="footer-logo">
                            <img class="logo-light" src="{{ setting('site_logo_white', asset('assets/img/logo-white.webp')) }}" alt="{{ setting('clinic_name', 'Clinic') }}" />
                            <img class="logo-dark" src="{{ setting('site_logo_white', asset('assets/img/logo-white.webp')) }}" alt="{{ setting('clinic_name', 'Clinic') }}" />
                        </a>
                        @if(setting('clinic_name'))
                        <h4 style="color: #fff; margin-top: 15px; margin-bottom: 15px;">{{ setting('clinic_name') }}</h4>
                        @endif
                        <p class="comp-desc">
                            {{ setting('footer_about_text', setting('about_description', 'We are committed to providing the highest quality dental care in a comfortable, caring environment.')) }}
                        </p>
                        <div class="contact-info">
                            <h6><i class="flaticon-pin"></i>{{ __('general.contact_address') }}</h6>
                            <p>{{ setting('footer_contact_address', setting('clinic_address', '64C East Crest, Melane Plaza, DanyBoyle, TT 3346, USA')) }}</p>
                        </div>
                        <ul class="social-profile list-style">
                            @if(setting('social_facebook'))
                            <li>
                                <a href="{{ setting('social_facebook') }}" target="_blank">
                                    <i class="ri-facebook-fill"></i>
                                </a>
                            </li>
                            @endif
                            @if(setting('social_twitter'))
                            <li>
                                <a href="{{ setting('social_twitter') }}" target="_blank">
                                    <i class="ri-twitter-fill"></i>
                                </a>
                            </li>
                            @endif
                            @if(setting('social_instagram'))
                            <li>
                                <a href="{{ setting('social_instagram') }}" target="_blank">
                                    <i class="ri-instagram-line"></i>
                                </a>
                            </li>
                            @endif
                            @if(setting('social_linkedin'))
                            <li>
                                <a href="{{ setting('social_linkedin') }}" target="_blank">
                                    <i class="ri-linkedin-fill"></i>
                                </a>
                            </li>
                            @endif
                            @if(setting('social_youtube'))
                            <li>
                                <a href="{{ setting('social_youtube') }}" target="_blank">
                                    <i class="ri-youtube-fill"></i>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-5 col-lg-6 col-md-12 col-sm-6 pe-xxl-6">
                    <div class="footer-widget">
                        <h3 class="footer-widget-title">Quick Links</h3>
                        <ul class="footer-menu list-style">
                            <li>
                                <a href="{{ route('home') }}">
                                    <i class="ri-arrow-right-double-line"></i>{{ __('menu.home') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('about') }}">
                                    <i class="ri-arrow-right-double-line"></i>{{ __('menu.about') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('services.index') }}">
                                    <i class="ri-arrow-right-double-line"></i>{{ __('menu.services') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('doctors.index') }}">
                                    <i class="ri-arrow-right-double-line"></i>{{ __('menu.dentists') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('contact') }}">
                                    <i class="ri-arrow-right-double-line"></i>{{ __('menu.contact') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('appointments.create') }}">
                                    <i class="ri-arrow-right-double-line"></i>{{ __('general.book_appointment') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('faq') }}">
                                    <i class="ri-arrow-right-double-line"></i>FAQ
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('blog.index') }}">
                                    <i class="ri-arrow-right-double-line"></i>Blog
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('testimonials') }}">
                                    <i class="ri-arrow-right-double-line"></i>Testimonials
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-12 col-sm-6 px-xxl-0">
                    <div class="footer-widget">
                        <h3 class="footer-widget-title">Clinic Hours</h3>
                        <ul class="opening-time list-style">
                            <li><span>Monday</span> <span>{{ setting('hours_monday', '9:00 AM - 6:00 PM') }}</span></li>
                            <li><span>Tuesday</span> <span>{{ setting('hours_tuesday', '9:00 AM - 6:00 PM') }}</span></li>
                            <li><span>Wednesday</span> <span>{{ setting('hours_wednesday', '9:00 AM - 6:00 PM') }}</span></li>
                            <li><span>Thursday</span> <span>{{ setting('hours_thursday', '9:00 AM - 6:00 PM') }}</span></li>
                            <li><span>Friday</span> <span>{{ setting('hours_friday', '9:00 AM - 5:00 PM') }}</span></li>
                            <li><span>Saturday</span> <span>{{ setting('hours_saturday', '10:00 AM - 3:00 PM') }}</span></li>
                            <li><span>Sunday</span> <span>{{ setting('hours_sunday', 'Closed') }}</span></li>
                        </ul>
                        <div class="contact-info">
                            <h6><i class="flaticon-phone-call"></i>Call Us</h6>
                            <a href="tel:{{ setting('clinic_phone', '+1 (555) 123-4567') }}">{{ setting('clinic_phone', '+1 (555) 123-4567') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p class="copyright-text">
        <i class="ri-copyright-line"></i>
        <span>{{ date('Y') }}</span> {{ setting('clinic_name', config('app.name')) }}. All Rights Reserved.
    </p>
</footer>
<!-- Footer End -->

<!-- Back to Top -->
<button type="button" id="backtotop" class="position-fixed text-center border-0 p-0">
    <i class="ri-arrow-up-line"></i>
</button>
