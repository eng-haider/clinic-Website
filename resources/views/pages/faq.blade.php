@extends('layouts.app')

@section('title', 'FAQ - ' . config('app.name'))

@section('content')
<!-- Breadcrumb Section Start -->
<div class="breadcrumb-wrap bg-f br-1">
    <div class="container">
        <div class="breadcrumb-title">
            <h2>Frequently Asked Questions</h2>
            <ul class="breadcrumb-menu list-style">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>FAQ</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- FAQ Section Start -->
<section class="faq-section ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="section-title text-center mb-5">
                    <span class="subtitle">Have Questions?</span>
                    <h2>Frequently Asked Questions</h2>
                    <p>Find answers to common questions about our dental services and clinic.</p>
                </div>

                <div class="accordion" id="faqAccordion">
                    <!-- FAQ 1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                How often should I visit the dentist?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>It is recommended to visit your dentist at least twice a year for regular check-ups and cleanings. However, the frequency may vary based on your individual oral health needs.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Do you accept dental insurance?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>Yes, we accept most major dental insurance plans. Please contact our office with your insurance information, and we'll verify your coverage and benefits.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                What should I do in a dental emergency?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>Call our office immediately if you have a dental emergency. We offer emergency dental services and will do our best to see you as soon as possible. For severe cases outside office hours, visit the nearest emergency room.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 4 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Are dental X-rays safe?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>Yes, dental X-rays are very safe. We use modern digital X-ray technology that produces significantly less radiation than traditional X-rays. We also take necessary precautions to minimize exposure.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 5 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                How can I prevent cavities?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>Brush your teeth twice daily with fluoride toothpaste, floss daily, limit sugary foods and drinks, visit your dentist regularly, and consider dental sealants for extra protection.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 6 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                                What are the payment options available?
                            </button>
                        </h2>
                        <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>We accept cash, credit/debit cards, and most dental insurance plans. We also offer flexible payment plans for larger treatments. Please discuss payment options with our staff during your visit.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 7 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq7">
                                How long does a dental cleaning take?
                            </button>
                        </h2>
                        <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>A typical dental cleaning appointment takes about 30-60 minutes. This includes the cleaning, examination, and any necessary X-rays. The exact time may vary based on your specific needs.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 8 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq8">
                                Can I whiten my teeth?
                            </button>
                        </h2>
                        <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>Yes, we offer professional teeth whitening services. Our dentist will evaluate your teeth and recommend the best whitening option for you. Professional whitening is safe and provides better results than over-the-counter products.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact CTA -->
                <div class="faq-contact mt-5 p-4 bg-light rounded text-center">
                    <h3>Still Have Questions?</h3>
                    <p>If you couldn't find the answer you're looking for, feel free to contact us directly.</p>
                    <div class="mt-3">
                        <a href="{{ route('contact') }}" class="btn style-one me-2">Contact Us</a>
                        <a href="{{ route('appointments.create') }}" class="btn style-two">{{ __('general.book_appointment') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- FAQ Section End -->
@endsection
