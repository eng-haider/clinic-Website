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
