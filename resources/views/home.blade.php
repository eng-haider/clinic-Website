@extends('layouts.app')

@section('title', setting('clinic_name', 'Home - Clinic Website'))

@section('content')
<div class="hero-sections-wrapper">
<!-- Hero Section Start -->
<div class="hero-wrap style-two hero-top-section" style="background-image: url('{{ setting('hero_background_image', asset('assets/img/hero/hero-img-2.webp')) }}');">
        <img src="{{ asset('assets/img/hero/hero-shape-8.webp') }}" alt="Image" class="hero-shape-two animationFramesTwo sm-none" />
    <img src="{{ asset('assets/img/hero/hero-shape-6.webp') }}" alt="Image" class="hero-shape-one" />

    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-7">
                <div class="hero-content">
                    <span>{{ setting('about_title', 'DENTAL CARE FOR EVERYONE') }}</span>
                    <h1>
                        Relax <img src="{{ asset('assets/img/hero/smily.webp') }}" alt="Image" /> Your
                        Dentist Knows Best
                    </h1>
                    <p>
                        {{ setting('about_description', 'Dolt always places patients at the center of our attention, and concentrate on improving their experience with the aid of technologies.') }}
                    </p>
                    <a href="{{ route('appointments.create') }}" class="btn-two">{{ __('general.book_appointment') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container hero-booking-section">
    <div class="hero-form-wrap">
        <div class="contact-item-wrap">
            <div class="contact-item">
                <div class="contact-item-content">
                    <i class="flaticon-mail contact-bg-icon"></i>
                    <h6>{{ __('general.contact_us') }}</h6>
                    <a href="tel:{{ setting('clinic_phone', '+1 202 345678') }}">{{ setting('clinic_phone', '+1 202 345678') }}</a>
                    <a href="mailto:{{ setting('clinic_email', 'contact@clinic.com') }}">{{ setting('clinic_email', 'contact@clinic.com') }}</a>
                </div>
            </div>
            <div class="contact-item">
                <div class="contact-item-content">
                    <i class="flaticon-pin contact-bg-icon"></i>
                    <h6>{{ __('general.location') }}</h6>
                    <p>{{ setting('clinic_address', '86 Brattle Street Cambridge, MA 02138') }}</p>
                </div>
            </div>
            <div class="contact-item">
                <div class="contact-item-content">
                    <i class="flaticon-clock contact-bg-icon"></i>
                    <h6>{{ __('general.opening_hours') }}</h6>
                    <p>{{ setting('hours_monday', 'Mon - Fri: 8:00am to 5:00pm') }}</p>
                    <p>{{ setting('hours_sunday', 'Sat - Sun: Close') }}</p>
                </div>
            </div>
        </div>
        <form id="heroBookingForm" action="{{ route('bookings.store') }}" method="POST" class="hero-form">
            @csrf
            <img src="{{ asset('assets/img/hero/hero-form-shape.webp') }}" alt="Image" class="hero-form-shape" />
            
            <!-- Success/Error Messages Container -->
            <div id="bookingMessages"></div>
            
            <div class="row ">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="patient_name"><i class="flaticon-user"></i>{{ __('general.your_name') }}</label>
                        <input type="text" id="patient_name" name="patient_name" placeholder="{{ __('general.enter_your_name') }}" value="{{ old('patient_name') }}" required dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" />
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="phone"><i class="flaticon-phone-call"></i>{{ __('general.phone_number') }}</label>
                        <input type="tel" id="phone" name="patient_phone" placeholder="{{ __('general.your_phone') }}" value="{{ old('patient_phone') }}" required dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" />
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="date"><i class="flaticon-clock"></i>{{ __('general.booking_date') }}</label>
                        <input type="date" id="date" name="booking_date" min="{{ date('Y-m-d') }}" value="{{ old('booking_date') }}" required dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" />
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <button type="submit" class="btn-two border-0" id="heroBookingBtn" style="    height: auto !important">
                            <span class="btn-text">{{ __('general.book_now') }}</span>
                            <span class="btn-loading" style="display: none;">
                                <i class="ri-loader-4-line" style="animation: spin 1s linear infinite;"></i>
                                {{ __('general.loading') }}...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Hero Section End -->

<!-- Medical File Quick Access Start -->
<section class="medical-file-quick-access hero-medical-section" style="padding: 2rem 0; background: linear-gradient(135deg, #10b981 0%, #0b6efd 100%); position: relative; overflow: hidden;">
    <!-- Decorative pattern -->
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="40" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="2"/></svg></div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Form Always Visible -->
                <div id="medicalFileForm" style="background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px); border-radius: 16px; padding: 2rem; border: 2px solid rgba(255, 255, 255, 0.2);">
                    <div style="text-align: center; margin-bottom: 1.5rem;">
                        <div style="background: rgba(255, 255, 255, 0.25); width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <i class="ri-folder-user-line" style="font-size: 2rem; color: #ffffff;"></i>
                        </div>
                        <h3 style="color: #ffffff; font-size: 1.5rem; font-weight: 700; margin: 0 0 0.5rem 0;">
                            شاهد ملفك الطبي
                        </h3>
                        <p style="color: rgba(255, 255, 255, 0.9); margin: 0; font-size: 0.95rem;">
                            الوصول الآمن إلى سجلاتك الطبية • جميع المعلومات محمية
                        </p>
                    </div>

                    <form id="quickAccessForm" onsubmit="handleQuickAccess(event)">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div style="margin-bottom: 1rem;">
                                    <label style="color: #ffffff; font-weight: 600; margin-bottom: 0.5rem; display: block; font-size: 0.95rem;">
                                        <i class="ri-qr-code-line"></i> رمز QR
                                    </label>
                                    <input 
                                        type="text" 
                                        id="quickPatientCode" 
                                        style="width: 100%; padding: 0.875rem 1rem; border: 2px solid rgba(255, 255, 255, 0.3); border-radius: 12px; background: rgba(255, 255, 255, 0.25); color: #ffffff; font-size: 1rem; font-weight: 600; transition: all 0.3s ease;"
                                        placeholder="أدخل رمز QR"
                                        required
                                        dir="rtl"
                                        onfocus="this.style.borderColor='rgba(255,255,255,0.6)'; this.style.background='rgba(255,255,255,0.35)';"
                                        onblur="this.style.borderColor='rgba(255,255,255,0.3)'; this.style.background='rgba(255,255,255,0.25)';"
                                    >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="margin-bottom: 1rem;">
                                    <label style="color: #ffffff; font-weight: 600; margin-bottom: 0.5rem; display: block; font-size: 0.95rem;">
                                        <i class="ri-phone-line"></i> رقم الهاتف
                                    </label>
                                    <input 
                                        type="tel" 
                                        id="quickPatientPhone" 
                                        style="width: 100%; padding: 0.875rem 1rem; border: 2px solid rgba(255, 255, 255, 0.3); border-radius: 12px; background: rgba(255, 255, 255, 0.25); color: #ffffff; font-size: 1rem; font-weight: 600; transition: all 0.3s ease;"
                                        placeholder="أدخل رقم الهاتف"
                                        required
                                        dir="rtl"
                                        onfocus="this.style.borderColor='rgba(255,255,255,0.6)'; this.style.background='rgba(255,255,255,0.35)';"
                                        onblur="this.style.borderColor='rgba(255,255,255,0.3)'; this.style.background='rgba(255,255,255,0.25)';"
                                    >
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 1.5rem;">
                            <button 
                                type="submit"
                                style="width: 100%; padding: 1rem; border: none; border-radius: 12px; background: rgba(255, 255, 255, 0.95); color: #10b981; font-size: 1rem; font-weight: 700; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0,0,0,0.15);"
                                onmouseover="this.style.background='#ffffff'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(0,0,0,0.2)'"
                                onmouseout="this.style.background='rgba(255,255,255,0.95)'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.15)'"
                            >
                                <i class="ri-arrow-left-line" style="transform: rotate(180deg);"></i> عرض السجلات الطبية
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
@keyframes shine {
    0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
    100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
}

/* Mobile responsive styles and section ordering */
@media (max-width: 768px) {
    /* Enable flexbox on wrapper for reordering */
    .hero-sections-wrapper {
        display: flex;
        flex-direction: column;
    }
    
    /* Hero top section (image/text) - order 1 */
    .hero-top-section {
        order: 1;
    }
    
    /* Medical file section - order 2 (appears before booking) */
    .hero-medical-section {
        order: 2;
        padding: 1.5rem 0 !important;
    }
    
    /* Booking section - order 3 (appears after medical file) */
    .hero-booking-section {
        order: 3;
    }
    
    #medicalFileForm {
        padding: 1.5rem 1rem !important;
    }

    #medicalFileForm h3 {
        font-size: 1.25rem !important;
    }
    
    #medicalFileForm input {
        font-size: 0.95rem !important;
        padding: 0.75rem !important;
    }
    
    #medicalFileForm button {
        font-size: 0.95rem !important;
        padding: 0.875rem !important;
    }
}

input::placeholder {
    color: rgba(255, 255, 255, 0.6);
}
</style>

<script>
function handleQuickAccess(event) {
    event.preventDefault();
    
    const code = document.getElementById('quickPatientCode').value.trim();
    const phone = document.getElementById('quickPatientPhone').value.trim();
    
    if (code && phone) {
        // Redirect to patient lookup page with parameters
        window.location.href = `{{ route('patient.lookup') }}?code=${encodeURIComponent(code)}&phone=${encodeURIComponent(phone)}`;
    }
}
</script>
<!-- Medical File Quick Access End -->
</div>
<!-- Hero Sections Wrapper End -->

<!-- Patient Lookup Section Start -->
<section class="patient-lookup-section ptb-100" style="display: none;">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="patient-lookup-card" data-aos="fade-up" style="background-image: url('{{ asset(setting('patient_lookup_bg', 'assets/img/hero/hero-img-2.webp')) }}'); background-size: cover; background-position: center; background-repeat: no-repeat; background-blend-mode: overlay;">
                    <div class="patient-lookup-header">
                        <div class="icon-wrapper">
                            <i class="ri-user-search-line"></i>
                        </div>
                        <h2>{{ __('general.patient_lookup') }}</h2>
                        <p>{{ __('general.patient_lookup_description') }}</p>
                    </div>
                    
                    <form id="patientLookupForm" class="patient-lookup-form">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="patientCode" class="form-label">
                                        <i class="ri-qr-code-line"></i>
                                        {{ __('general.qr_code') }}
                                    </label>
                                    <input 
                                        type="text" 
                                        id="patientCode" 
                                        class="form-control" 
                                        placeholder="{{ __('general.enter_qr_code') }}"
                                        required
                                        autocomplete="off"
                                        dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
                                    >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="patientPhone" class="form-label">
                                        <i class="ri-phone-line"></i>
                                        {{ __('general.phone_number') }}
                                    </label>
                                    <input 
                                        type="tel" 
                                        id="patientPhone" 
                                        class="form-control" 
                                        placeholder="{{ __('general.enter_phone_number') }}"
                                        required
                                        autocomplete="off"
                                        dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="error-message" id="errorMessage"></div>
                        
                        <button type="submit" class="btn btn-lookup" style="margin-top: 1.25rem;">
                            <span class="btn-text">{{ __('general.view_medical_records') }}</span>
                            <span class="btn-loading" style="display: none;">
                                <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                                {{ __('general.loading') }}
                            </span>
                            <i class="ri-arrow-right-line"></i>
                        </button>
                    </form>
                    
                    <div class="patient-lookup-features">
                        <div class="feature-item">
                            <i class="ri-shield-check-line"></i>
                            <span>{{ __('general.secure_access') }}</span>
                        </div>
                        <div class="feature-item">
                            <i class="ri-time-line"></i>
                            <span>{{ __('general.available_247') }}</span>
                        </div>
                        <div class="feature-item">
                            <i class="ri-lock-password-line"></i>
                            <span>{{ __('general.two_factor_verification') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.hero-wrap.style-two{
    background-position: center center !important;
}

.others-option {
    margin-right: 190px !important;
}

/* Mobile phone specific styles */
@media (max-width: 767px) {
    .hero-wrap.style-two {
        background-size: 100% 100% !important;
    }
}
/* Patient Lookup Section Styles */
.patient-lookup-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    position: relative;
    overflow: hidden;
}

.patient-lookup-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><rect width="100" height="100" fill="none"/><path d="M0 0L100 100M100 0L0 100" stroke="rgba(16,185,129,0.02)" stroke-width="1"/></svg>');
    opacity: 0.5;
    pointer-events: none;
}

.patient-lookup-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    position: relative;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.patient-lookup-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 6px;
    background: linear-gradient(90deg, #10b981 0%, #0b6efd 100%);
    opacity: 0.8;
    z-index: 1;
}

.patient-lookup-card::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.95);
    z-index: 0;
}

.patient-lookup-card > * {
    position: relative;
    z-index: 1;
}

.patient-lookup-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 60px rgba(0,0,0,0.12);
}

.patient-lookup-header {
    text-align: center;
    margin-bottom: 1.5rem;
}

.patient-lookup-header .icon-wrapper {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #10b981 0%, #0b6efd 100%);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    box-shadow: 0 6px 16px rgba(16,185,129,0.3);
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.patient-lookup-header .icon-wrapper i {
    font-size: 2rem;
    color: #ffffff;
}

.patient-lookup-header h2 {
    font-family: 'Cairo', sans-serif;
    font-size: 1.75rem;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 0.5rem;
    letter-spacing: -0.5px;
}

.patient-lookup-header p {
    font-family: 'Cairo', sans-serif;
    font-size: 1rem;
    color: #64748b;
    line-height: 1.5;
    max-width: 600px;
    margin: 0 auto;
}

.patient-lookup-form {
    margin-bottom: 1.5rem;
}

.patient-lookup-form .form-group {
    margin-bottom: 0;
}

.patient-lookup-form .form-label {
    font-family: 'Cairo', sans-serif;
    font-size: 0.875rem;
    font-weight: 600;
    color: #334155;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.4rem;
}

.patient-lookup-form .form-label i {
    color: #10b981;
    font-size: 1rem;
}

.patient-lookup-form .form-control {
    font-family: 'Cairo', sans-serif;
    font-size: 1rem;
    padding: 0.75rem 1rem;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    transition: all 0.3s ease;
    background: #f8fafc;
    min-height: 48px;
}

.patient-lookup-form .form-control:focus {
    outline: none;
    border-color: #10b981;
    background: #ffffff;
    box-shadow: 0 0 0 4px rgba(16,185,129,0.1);
    transform: translateY(-2px);
}

.patient-lookup-form .form-control::placeholder {
    color: #94a3b8;
}

.patient-lookup-form .error-message {
    font-family: 'Cairo', sans-serif;
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.5rem;
    display: none;
    animation: shake 0.3s ease;
}

.patient-lookup-form .error-message.show {
    display: block;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-10px); }
    75% { transform: translateX(10px); }
}

.btn-lookup {
    font-family: 'Cairo', sans-serif;
    font-size: 1.125rem;
    font-weight: 700;
    background: linear-gradient(135deg, #10b981 0%, #0b6efd 100%);
    color: #ffffff;
    border: none;
    border-radius: 14px;
    padding: 1rem 2rem;
    width: 100%;
    min-height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 14px rgba(16,185,129,0.3);
    position: relative;
    overflow: hidden;
}

.btn-lookup::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s ease;
}

.btn-lookup:hover::before {
    left: 100%;
}

.btn-lookup:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(16,185,129,0.4);
}

.btn-lookup:active {
    transform: translateY(-1px);
}

.btn-lookup i {
    font-size: 1.25rem;
    transition: transform 0.3s ease;
}

.btn-lookup:hover i {
    transform: translateX(5px);
}

.btn-lookup.loading .btn-text,
.btn-lookup.loading i {
    display: none;
}

.btn-lookup.loading .btn-loading {
    display: flex !important;
    align-items: center;
}

.patient-lookup-features {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1.5rem;
    padding-top: 2rem;
    border-top: 2px solid #f1f5f9;
}

.feature-item {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    font-family: 'Cairo', sans-serif;
    color: #475569;
    font-size: 1rem;
    font-weight: 600;
}

.feature-item i {
    color: #10b981;
    font-size: 1.5rem;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .patient-lookup-card {
        padding: 2rem 1.5rem;
        border-radius: 20px;
    }
    
    .patient-lookup-header h2 {
        font-size: 1.875rem;
    }
    
    .patient-lookup-header p {
        font-size: 1rem;
    }
    
    .patient-lookup-header .icon-wrapper {
        width: 70px;
        height: 70px;
    }
    
    .patient-lookup-header .icon-wrapper i {
        font-size: 2rem;
    }
    
    .patient-lookup-features {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
}


.hero-form{
    display: block !important
}
@media (max-width: 480px) {
    .patient-lookup-card {
        padding: 1.5rem 1rem;
    }
    
    .patient-lookup-header h2 {
        font-size: 1.5rem;
    }
    
    .btn-lookup {
        font-size: 1rem;
        padding: 0.875rem 1.5rem;
    }
}

/* RTL Support */
[dir="rtl"] .patient-lookup-header .icon-wrapper,
[dir="rtl"] .feature-item {
    direction: rtl;
}

[dir="rtl"] .btn-lookup i {
    transform: scaleX(-1);
}

[dir="rtl"] .btn-lookup:hover i {
    transform: scaleX(-1) translateX(5px);
}

/* Accessibility */
@media (prefers-reduced-motion: reduce) {
    .patient-lookup-card,
    .patient-lookup-header .icon-wrapper,
    .btn-lookup,
    .patient-lookup-form .form-control {
        animation: none;
        transition: none;
    }
}

/* Focus visible for keyboard navigation */
.btn-lookup:focus-visible,
.patient-lookup-form .form-control:focus-visible {
    outline: 3px solid #10b981;
    outline-offset: 2px;
}

</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('patientLookupForm');
    const inputCode = document.getElementById('patientCode');
    const inputPhone = document.getElementById('patientPhone');
    const errorMessage = document.getElementById('errorMessage');
    const submitBtn = form.querySelector('.btn-lookup');
    
    // Form submission handler
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Clear previous errors
        errorMessage.textContent = '';
        errorMessage.classList.remove('show');
        inputCode.classList.remove('is-invalid');
        inputPhone.classList.remove('is-invalid');
        
        // Get and validate inputs
        const patientCode = inputCode.value.trim();
        const patientPhone = inputPhone.value.trim();
        
        if (!patientCode) {
            showError('Please enter your QR code');
            inputCode.classList.add('is-invalid');
            return;
        }
        
        if (!patientPhone) {
            showError('Please enter your phone number');
            inputPhone.classList.add('is-invalid');
            return;
        }
        
        if (patientCode.length < 3) {
            showError('QR code must be at least 3 characters');
            inputCode.classList.add('is-invalid');
            return;
        }
        
        if (patientPhone.length < 10) {
            showError('Please enter a valid phone number');
            inputPhone.classList.add('is-invalid');
            return;
        }
        
        // Show loading state
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
        
        // Redirect to patient lookup page with code and phone_number
        setTimeout(() => {
            window.location.href = `/patient-lookup?code=${encodeURIComponent(patientCode)}&phone_number=${encodeURIComponent(patientPhone)}`;
        }, 300);
    });
    
    // Clear error on input for code field
    inputCode.addEventListener('input', function() {
        if (errorMessage.classList.contains('show')) {
            errorMessage.textContent = '';
            errorMessage.classList.remove('show');
            inputCode.classList.remove('is-invalid');
        }
    });
    
    // Clear error on input for phone field
    inputPhone.addEventListener('input', function() {
        if (errorMessage.classList.contains('show')) {
            errorMessage.textContent = '';
            errorMessage.classList.remove('show');
            inputPhone.classList.remove('is-invalid');
        }
    });
    
    // Show error message
    function showError(message) {
        errorMessage.textContent = message;
        errorMessage.classList.add('show');
    }
    
    // Handle Enter key in input fields
    inputCode.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            form.dispatchEvent(new Event('submit', { cancelable: true, bubbles: true }));
        }
    });
    
    inputPhone.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            form.dispatchEvent(new Event('submit', { cancelable: true, bubbles: true }));
        }
    });
});
</script>
<!-- Patient Lookup Section End -->

<!-- Services Section Start -->
@if($services->count() > 0)
<section class="service-section ptb-100">
    <div class="container">
        <div class="section-title text-center">
            <span class="subtitle">{{ __('general.our_services') }}</span>
            <h2>{{ __('general.what_we_offer') }}</h2>
        </div>
        <div class="row justify-content-center">
            @foreach($services as $service)
            <div class="col-xl-4 col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="service-card">
                    @if($service->icon)
                    <i class="{{ $service->icon }}"></i>
                    @endif
                    @if($service->image)
                    <img src="{{ service_image($service->image) }}" alt="{{ $service->title }}">
                    @endif
                    <h3><a href="{{ route('services.show', $service) }}">{{ $service->title }}</a></h3>
                    <p>{{ $service->description }}</p>
                    <a href="{{ route('services.show', $service) }}" class="link-one">{{ __('general.read_more') }}</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<!-- Services Section End -->

<!-- Doctors Section Start -->
@if($doctors->count() > 0)
<section class="team-section bg-grey ptb-100">
    <div class="container">
        <div class="section-title text-center">
            <span class="subtitle">Our Team</span>
            <h2>Meet Our Expert Dentists</h2>
        </div>
        <div class="row justify-content-center">
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
    </div>
</section>
@endif
<!-- Doctors Section End -->

<!-- Testimonials Section Start -->
@if($testimonials->count() > 0)
<section class="testimonial-section ptb-100">
    <div class="container">
        <div class="section-title text-center">
            <span class="subtitle">Testimonials</span>
            <h2>What Our Patients Say</h2>
        </div>
        <div class="testimonial-slider swiper">
            <div class="swiper-wrapper">
                @foreach($testimonials as $testimonial)
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <p>"{{ $testimonial->content }}"</p>
                        <div class="client-img">
                            @if($testimonial->image)
                            <img src="{{ client_image($testimonial->image) }}" alt="{{ $testimonial->patient_name }}">
                            @endif
                            <div>
                                <h4>{{ $testimonial->patient_name }}</h4>
                                @if($testimonial->patient_title)
                                <span>{{ $testimonial->patient_title }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="rating">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $testimonial->rating)
                                <i class="ri-star-fill"></i>
                                @else
                                <i class="ri-star-line"></i>
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
@endif
<!-- Testimonials Section End -->

<!-- Blog Section Start -->
@if($posts->count() > 0)
<section class="blog-section bg-grey ptb-100">
    <div class="container">
        <div class="section-title text-center">
            <span class="subtitle">Latest News</span>
            <h2>Recent Blog Posts</h2>
        </div>
        <div class="row justify-content-center">
            @foreach($posts as $post)
            <div class="col-xl-4 col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="blog-card">
                    @if($post->featured_image)
                    <img src="{{ blog_image($post->featured_image) }}" alt="{{ $post->title }}">
                    @else
                    <img src="{{ asset('assets/img/blog/blog-1.webp') }}" alt="{{ $post->title }}">
                    @endif
                    <div class="blog-info">
                        <ul class="blog-metainfo">
                            <li><i class="ri-calendar-line"></i>{{ $post->published_at->format('M d, Y') }}</li>
                            @if($post->author)
                            <li><i class="ri-user-line"></i>{{ $post->author }}</li>
                            @endif
                        </ul>
                        <h3><a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a></h3>
                        @if($post->excerpt)
                        <p>{{ $post->excerpt }}</p>
                        @endif
                        <a href="{{ route('blog.show', $post) }}" class="link-one">{{ __('general.read_more') }}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<!-- Blog Section End -->
@endsection

@push('styles')
<style>
/* Toast Notification Styles */
.toast-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    min-width: 300px;
    max-width: 400px;
    padding: 15px 20px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    z-index: 9999;
    animation: slideInRight 0.3s ease-out;
    font-size: 15px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.toast-notification.success {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
}

.toast-notification.error {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
}

.toast-notification i {
    font-size: 24px;
    flex-shrink: 0;
}

.toast-notification .toast-content {
    flex: 1;
}

.toast-notification .toast-title {
    font-weight: 600;
    margin-bottom: 3px;
    font-size: 16px;
}

.toast-notification .toast-message {
    font-size: 14px;
    opacity: 0.95;
}

.toast-notification .toast-close {
    background: none;
    border: none;
    color: white;
    font-size: 20px;
    cursor: pointer;
    padding: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0.8;
    transition: opacity 0.2s;
    flex-shrink: 0;
}

.toast-notification .toast-close:hover {
    opacity: 1;
}

@keyframes slideInRight {
    from {
        transform: translateX(400px);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOutRight {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(400px);
        opacity: 0;
    }
}

@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

/* RTL Support for Toast */
html[dir="rtl"] .toast-notification {
    right: auto;
    left: 20px;
    animation: slideInLeft 0.3s ease-out;
}

@keyframes slideInLeft {
    from {
        transform: translateX(-400px);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

html[dir="rtl"] @keyframes slideOutRight {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(-400px);
        opacity: 0;
    }
}

/* Hero Form Custom Styles */
#heroBookingForm {
    position: relative;
}

#heroBookingForm .row {
    margin: 0 -10px;
}

#heroBookingForm .row > [class*='col-'] {
    padding: 0 10px;
}

#heroBookingForm .form-group {
    margin-bottom: 0;
    height: 100%;
}

#heroBookingForm .form-group input[type="text"],
#heroBookingForm .form-group input[type="tel"],
#heroBookingForm .form-group input[type="date"] {
    color: #fff !important;
    font-weight: 500;
    transition: all 0.3s ease;
    width: 100%;
}

#heroBookingForm .form-group input::placeholder {
    color: rgba(255, 255, 255, 0.7) !important;
}

#heroBookingForm .form-group input:focus {
    color: #fff !important;
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
}

/* Smooth input transitions */
#heroBookingForm .form-group input {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

#heroBookingForm .form-group input:hover {
    transform: translateY(-1px);
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
}

/* Date input specific styling */
#heroBookingForm .form-group input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(1);
    cursor: pointer;
}

/* Button full width in grid */
#heroBookingForm .form-group button {
    width: 100%;
    height: 100%;
    min-height: 58px;
}

/* Grid spacing */
#heroBookingForm .g-3 {
    --bs-gutter-x: 1.5rem;
    --bs-gutter-y: 1.5rem;
}

/* Responsive adjustments */
@media (max-width: 991px) {
    #heroBookingForm .col-lg-6 {
        margin-bottom: 1rem;
    }
    
    #heroBookingForm .col-lg-6:last-child {
        margin-bottom: 0;
    }
}

/* Contact icons styling - Background Icons */
.contact-item-wrap {
    position: relative;
    z-index: 2;
}

/* Desktop only - top position */
@media (min-width: 992px) {
    .hero-form-wrap .contact-item-wrap .contact-item i {
        top: 60px !important;
    }
}

.contact-item {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.contact-item:hover {
    transform: translateY(-5px);
}

.contact-item-content {
    position: relative;
    z-index: 2;
}

.contact-bg-icon {
    position: absolute;
    font-size: 60px !important;
    color: var(--primaryColor);
    opacity: 0.08;
    z-index: 1;
    transition: all 0.5s ease;
    top: 50%;
    right: -20px;
    transform: translateY(-50%);
    pointer-events: none;
}

[dir="rtl"] .contact-bg-icon {
    right: auto;
    left: -20px;
}

.contact-item:hover .contact-bg-icon {
    opacity: 0.12;
    transform: translateY(-50%) scale(1.1) rotate(10deg);
    color: var(--optionalColor);
}

.contact-item h6 {
    position: relative;
    z-index: 2;
    font-weight: 700;
    margin-bottom: 10px;
}

.contact-item a,
.contact-item p {
    position: relative;
    z-index: 2;
}

/* Mobile/Phone Responsive for Contact Items */
@media (max-width: 767px) {
    .contact-item-wrap {
        gap: 15px !important;
    }
    
    .contact-item {
        padding: 15px !important;
        min-height: auto !important;
    }
    
    .contact-bg-icon {
        font-size: 70px !important;
        right: -10px;
    }
    
    [dir="rtl"] .contact-bg-icon {
        left: -10px;
    }
    
    .contact-item h6 {
        font-size: 14px !important;
        margin-bottom: 6px !important;
    }
    
    .contact-item a,
    .contact-item p {
        font-size: 12px !important;
        line-height: 1.4 !important;
    }
    
    .contact-item p {
        margin-bottom: 4px !important;
    }
}

@media (max-width: 480px) {
    .contact-item {
        padding: 12px !important;
    }
    
    .contact-bg-icon {
        font-size: 60px !important;
    }
    
    .contact-item h6 {
        font-size: 13px !important;
    }
    
    .contact-item a,
    .contact-item p {
        font-size: 11px !important;
    }
}

/* Form smooth animations */
#heroBookingForm {
    animation: formFadeIn 0.6s ease-out;
}

@keyframes formFadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

#heroBookingForm .form-group {
    animation: slideInUp 0.5s ease-out forwards;
    opacity: 0;
}

#heroBookingForm .form-group:nth-child(1) {
    animation-delay: 0.1s;
}

#heroBookingForm .form-group:nth-child(2) {
    animation-delay: 0.2s;
}

#heroBookingForm .form-group:nth-child(3) {
    animation-delay: 0.3s;
}

#heroBookingForm .form-group:nth-child(4) {
    animation-delay: 0.4s;
}

#heroBookingForm .form-group:nth-child(5) {
    animation-delay: 0.5s;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Label icon styling */
#heroBookingForm .form-group label i {
    margin-right: 8px;
    font-size: 18px;
    vertical-align: middle;
    transition: transform 0.3s ease;
}

#heroBookingForm .form-group:hover label i {
    transform: scale(1.15);
}

/* Submit button smooth effect */
#heroBookingBtn {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

#heroBookingBtn::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

#heroBookingBtn:hover::before {
    width: 300px;
    height: 300px;
}

#heroBookingBtn:active {
    transform: scale(0.95);
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('heroBookingForm');
    const submitBtn = document.getElementById('heroBookingBtn');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoading = submitBtn.querySelector('.btn-loading');
    
    // Toast notification functions
    function showToast(type, title, message) {
        const toast = document.createElement('div');
        toast.className = `toast-notification ${type}`;
        
        const icon = type === 'success' 
            ? '<i class="ri-check-circle-line"></i>' 
            : '<i class="ri-error-warning-line"></i>';
        
        toast.innerHTML = `
            ${icon}
            <div class="toast-content">
                <div class="toast-title">${title}</div>
                <div class="toast-message">${message}</div>
            </div>
            <button class="toast-close" onclick="this.parentElement.remove()">×</button>
        `;
        
        document.body.appendChild(toast);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            toast.style.animation = 'slideOutRight 0.3s ease-out';
            setTimeout(() => toast.remove(), 300);
        }, 5000);
    }
    
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Show loading state
        btnText.style.display = 'none';
        btnLoading.style.display = 'inline-block';
        submitBtn.disabled = true;
        
        const formData = new FormData(form);
        
        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            });
            
            const data = await response.json();
            
            if (response.ok && data.success) {
                showToast('success', '{{ __("general.success") }}', data.message);
                form.reset();
                
                // Reset min date
                document.getElementById('date').min = new Date().toISOString().split('T')[0];
            } else {
                const errorMessage = data.message || '{{ __("general.error_occurred") }}';
                showToast('error', '{{ __("general.error") }}', errorMessage);
            }
        } catch (error) {
            console.error('Booking error:', error);
            showToast('error', '{{ __("general.error") }}', '{{ __("general.network_error") }}');
        } finally {
            // Hide loading state
            btnText.style.display = 'inline-block';
            btnLoading.style.display = 'none';
            submitBtn.disabled = false;
        }
    });
});
</script>
@endpush
