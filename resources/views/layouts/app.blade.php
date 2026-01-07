<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ setting('meta_description', 'Professional dental clinic offering comprehensive dental care services.') }}">
    <meta name="keywords" content="{{ setting('meta_keywords', 'dental clinic, dentist, dental care') }}">

    <title>@yield('title', setting('clinic_name', config('app.name', 'Clinic Website')))</title>

    @if(app()->getLocale() == 'ar')
    <!-- RTL Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" />
    @else
    <!-- LTR Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    @endif
    
    <!-- Link of CSS files -->
    <link rel="stylesheet" href="{{ asset('assets/css/remixicon.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon_dolt.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/swiper.bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/dark-theme.css') }}" />

    @if(app()->getLocale() == 'ar')
    <!-- RTL Custom Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/rtl.css') }}" />
    @endif

    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.webp') }}" />

    @stack('styles')
    
    <style>
        /* Force RTL for Arabic */
        html[dir="rtl"] body {
            direction: rtl !important;
            text-align: right !important;
        }
        
        /* ============================================
           MOBILE NAVIGATION FIXES
           ============================================ */
        
        /* Hide header-top on mobile */
        @media only screen and (max-width: 991px) {
            .navbar-area .header-top {
                display: none !important;
            }
            
            /* Fix mobile navbar spacing */
            .navbar-area .navbar {
                padding: 12px 0 !important;
            }
            
            /* Logo sizing on mobile */
            .navbar-area .navbar .navbar-brand img {
                height: 60px !important;
                width: auto;
            }
            
            /* Mobile toggler button */
            .navbar-area .other-option {
                margin-left: auto;
                display: flex;
                align-items: center;
                gap: 10px;
            }
            
            .navbar-toggler {
                padding: 8px;
                border: none;
                background: transparent;
            }
            
            .burger-menu {
                display: flex;
                flex-direction: column;
                gap: 4px;
                width: 25px;
            }
            
            .burger-menu span {
                display: block;
                height: 3px;
                width: 100%;
                background: var(--color-primary);
                border-radius: 2px;
                transition: all 0.3s ease;
            }
            
            /* Fix for desktop menu items on mobile - hide completely */
            .navbar-area .navbar-collapse {
                display: none !important;
            }
        }
        
        /* RTL Mobile fixes */
        @media only screen and (max-width: 991px) {
            body[dir="rtl"] .navbar-area .navbar {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            
            body[dir="rtl"] .navbar-area .navbar .navbar-brand {
                order: 1;
                margin-left: 0;
                margin-right: 0;
            }
            
            body[dir="rtl"] .navbar-area .other-option {
                order: 2;
                margin-right: 0;
                margin-left: auto;
            }
            
            body[dir="rtl"] .navbar-toggler {
                margin-left: 0;
                margin-right: 0;
            }
        }
        
        /* Offcanvas mobile menu improvements */
        @media only screen and (max-width: 991px) {
            .responsive-navbar.offcanvas {
                width: 85% !important;
                max-width: 320px;
            }
            
            body[dir="rtl"] .responsive-navbar.offcanvas {
                left: 0 !important;
                right: auto !important;
            }
            
            body[dir="rtl"] .responsive-navbar .offcanvas-header {
                direction: rtl;
                text-align: right;
            }
            
            body[dir="rtl"] .responsive-navbar .offcanvas-body {
                direction: rtl;
                text-align: right;
            }
            
            .responsive-navbar .accordion-link {
                padding: 12px 20px;
                display: block;
                font-size: 15px;
                border-bottom: 1px solid rgba(0,0,0,0.05);
            }
        }
        
        /* Fix container padding on mobile */
        @media only screen and (max-width: 767px) {
            .navbar-area .container {
                padding-left: 15px;
                padding-right: 15px;
            }
            
            /* Smaller logo on very small screens */
            .navbar-area .navbar .navbar-brand img {
                height: 50px !important;
            }
        }
        
        /* Sticky navbar mobile fix */
        @media only screen and (max-width: 991px) {
            .navbar-area.sticky {
                top: 0 !important;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }
            
            .navbar-area.sticky .header-top {
                display: none !important;
            }
        }
    </style>
</head>
<body dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <!--  Preloader Start -->
    <div class="loader-wrapper">
        <div class="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!--  Preloader End -->

    <!-- Theme Switcher Start -->
    <div class="switch-theme-mode">
        <label id="switch" class="switch">
            <input type="checkbox" onchange="toggleTheme()" id="slider" />
            <span class="slider round"></span>
        </label>
    </div>
    <!-- Theme Switcher End -->

    @include('partials.header')

    @yield('content')

    @include('partials.footer')

    <!-- Link of JS files -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/aos.js') }}"></script>
    <script src="{{ asset('assets/js/fslightbox.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @stack('scripts')
</body>
</html>
