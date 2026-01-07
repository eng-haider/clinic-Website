<!-- Start Navbar Area -->
<div class="navbar-area style-one" id="navbar">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <ul class="contact-info list-style">
                        <li>
                            <i class="flaticon-mail"></i>
                            <a href="mailto:{{ setting('clinic_email', 'info@clinic.com') }}">
                                {{ setting('clinic_email', 'info@clinic.com') }}
                            </a>
                        </li>
                        <li>
                            <i class="flaticon-pin"></i>{{ setting('clinic_address', '86 Brattle Street Cambridge, MA 0138, USA') }}
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <ul class="contact-info text-lg-end list-style">
                        <li>
                            <i class="flaticon-clock"></i>{{ setting('hours_monday', 'Mon - Sat: 09.00 to 18.00') }} - {{ setting('hours_friday', 'Sunday: Closed') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img class="logo-light" style="height: 90px" src="{{ setting('site_logo', asset('assets/img/logo.webp')) }}" alt="logo" />
                <img class="logo-dark" src="{{ setting('site_logo_white', asset('assets/img/logo-white.webp')) }}" alt="logo" />
            </a>
            <div class="other-option d-flex align-items-center justify-content-end d-lg-none">
                {{-- <button type="button" class="search-btn d-lg-none" data-bs-toggle="modal" data-bs-target="#searchModal">
                    <i class="flaticon-search"></i>
                </button> --}}
                <a class="navbar-toggler" data-bs-toggle="offcanvas" href="#navbarOffcanvas" role="button" aria-controls="navbarOffcanvas">
                    <span class="burger-menu">
                        <span class="top-bar"></span>
                        <span class="middle-bar"></span>
                        <span class="bottom-bar"></span>
                    </span>
                </a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav main-nav">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">{{ __('menu.home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('doctors.index') }}" class="nav-link {{ request()->routeIs('doctors.*') ? 'active' : '' }}">{{ __('menu.dentists') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('services.index') }}" class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}">{{ __('menu.services') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="dropdown-toggle nav-link">{{ __('menu.pages') }}</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a href="{{ route('about') }}" class="nav-link">{{ __('menu.about_us') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('appointments.create') }}" class="nav-link">{{ __('menu.book_appointment') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('testimonials') }}" class="nav-link">{{ __('menu.testimonials') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('faq') }}" class="nav-link">{{ __('menu.faq') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('blog.index') }}" class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}">{{ __('menu.blog') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">{{ __('menu.contact_us') }}</a>
                    </li>
                </ul>
                <div class="others-option d-flex align-items-center">
                    {{-- <div class="option-item">
                        <button type="button" class="search-btn" data-bs-toggle="modal" data-bs-target="#searchModal">
                            <i class="flaticon-search"></i>
                        </button>
                    </div> --}}
                    <!-- Language Switcher -->
                    <div class="option-item">
                        <form action="{{ route('language.switch') }}" method="POST" class="d-inline language-switcher">
                            @csrf
                            <input type="hidden" name="locale" value="{{ app()->getLocale() == 'ar' ? 'en' : 'ar' }}">
                            <button type="submit" class="btn btn-link text-decoration-none p-0 d-flex align-items-center" style="border: none; background: none; cursor: pointer;" title="{{ __('menu.switch_language') }}">
                                <i class="ri-global-line" style="font-size: 24px; color: var(--color-primary);"></i>
                                <span class="ms-1" style="color: var(--color-heading); font-weight: 500;">
                                    {{ app()->getLocale() == 'ar' ? 'EN' : 'AR' }}
                                </span>
                            </button>
                        </form>
                    </div>
                    <div class="option-item">
                        <div class="contact-item">
                            <i class="flaticon-emergency-call"></i>
                            <span>{{ __('menu.phone_number') }}</span>
                            <a href="tel:{{ setting('phone', '+968547856254') }}">{{ setting('phone', '+968 547856 254') }}</a>
                        </div>
                    </div>
                    <div class="option-item">
                        <a class="sidebar-toggler" data-bs-toggle="offcanvas" href="#navbarOffcanvas" role="button" aria-controls="navbarOffcanvas">
                            <i class="flaticon-list"></i>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- End Navbar Area -->

<!-- Start Responsive Navbar Area -->
<div class="responsive-navbar offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="navbarOffcanvas">
    <div class="offcanvas-header">
        <a href="{{ url('/') }}" class="logo d-inline-block">
            <img class="logo-light" style="height: 90px" src="{{ asset('assets/img/logo.webp') }}" alt="logo" />
            <img class="logo-dark" src="{{ asset('assets/img/logo-white.webp') }}" alt="logo" />
        </a>
        <button type="button" class="close-btn" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="ri-close-line"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <div class="accordion" id="navbarAccordion">
            <div class="accordion-item">
                <a class="accordion-link" href="{{ route('home') }}">{{ __('menu.home') }}</a>
            </div>
            <div class="accordion-item">
                <a class="accordion-link" href="{{ route('doctors.index') }}">{{ __('menu.dentists') }}</a>
            </div>
            <div class="accordion-item">
                <a class="accordion-link" href="{{ route('services.index') }}">{{ __('menu.services') }}</a>
            </div>
            <div class="accordion-item">
                <a class="accordion-link" href="{{ route('about') }}">{{ __('menu.about_us') }}</a>
            </div>
            <div class="accordion-item">
                <a class="accordion-link" href="{{ route('appointments.create') }}">{{ __('menu.book_appointment') }}</a>
            </div>
            <div class="accordion-item">
                <a class="accordion-link" href="{{ route('testimonials') }}">{{ __('menu.testimonials') }}</a>
            </div>
            <div class="accordion-item">
                <a class="accordion-link" href="{{ route('faq') }}">{{ __('menu.faq') }}</a>
            </div>
            <div class="accordion-item">
                <a class="accordion-link" href="{{ route('blog.index') }}">{{ __('menu.blog') }}</a>
            </div>
            <div class="accordion-item">
                <a class="accordion-link" href="{{ route('contact') }}">{{ __('menu.contact_us') }}</a>
            </div>
            
            <!-- Phone Number Mobile -->
            <div class="accordion-item mt-3 border-top pt-3">
                <div class="mobile-contact-info" style="padding: 12px 20px;">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="flaticon-emergency-call" style="font-size: 20px; color: var(--color-primary);"></i>
                        <div>
                            <small class="d-block" style="font-size: 12px; color: #666;">{{ __('menu.phone_number') }}</small>
                            <a href="tel:{{ setting('phone', '+968547856254') }}" style="color: var(--color-heading); font-weight: 600;">{{ setting('phone', '+968 547856 254') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Language Switcher Mobile -->
            <div class="accordion-item">
                <form action="{{ route('language.switch') }}" method="POST" style="padding: 12px 20px;">
                    @csrf
                    <input type="hidden" name="locale" value="{{ app()->getLocale() == 'ar' ? 'en' : 'ar' }}">
                    <button type="submit" class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center gap-2">
                        <i class="ri-global-line"></i>
                        <span>{{ app()->getLocale() == 'ar' ? 'English' : 'العربية' }}</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Responsive Navbar Area -->

<!-- Search Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchModalLabel">Search</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="{{ __('general.search') }}..." required>
                        <button class="btn btn-primary" type="submit">{{ __('general.search') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
