@extends('frontend.layouts.app')
@section('content')

    <main class="main">
        <section class="section">
            <div class="container">
                <div class="banner-1">
                    <div class="row align-items-center">
                        <div class="col-lg-7">
                            <h1 class="color-brand-5 mb-20 text-anim">
                                {{ $homepageSettings['homepage_section_1_heading'] ?? 'The data layer between your business and its potential.' }}
                            </h1>
                            <div class="row">
                                <div class="col-lg-9 wow animate__animated animate__fadeInUp"   data-wow-delay=".2s">
                                    <p class="font-md color-grey-500 mb-30">
                                        {{ $homepageSettings['homepage_section_1_desc'] ?? 'Optimize write performance with a document data model that maps to your application’s access patterns. Meet a wide range of query requirements via a single query API that supports everything from simple lookups to complex processing pipelines for data analytics and transformations.' }}
                                    </p>
                                </div>
                            </div>
                            <div class="box-button mt-30 wow animate__animated animate__fadeInUp" data-wow-delay=".4s"><a
                                    class="btn btn-brand-5 hover-up" href="#">Contact Us</a></div>
                        </div>
                        <div class="col-lg-5 d-none d-lg-block wow animate__animated animate__fadeIn">
                            <object data="{{ asset('asset/frontend/imgs/page/homepage1/hero-banner.svg') }}"
                                type="image/svg+xml"></object>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="box-radius-bottom">
                <div class="container">
                    <div class="text-center">
                        <h3 class="color-brand-5 mb-15 wow animate__animated animate__fadeInUp" data-wow-delay=".0s">Loved
                            By Developers, Trusted By Enterprises</h3>
                        <p class="font-lg color-grey-500 wow animate__animated animate__fadeInUp" data-wow-delay=".0s">We
                            helped these brands turn online assessments into success stories.<br
                                class="d-none d-lg-block">Join them. Elevate your testing.</p>
                    </div>
                    <div class="mt-30 wow animate__animated animate__fadeInUp" data-wow-delay=".0s">
                        <div class="box-swiper">
                            <div class="swiper-container swiper-group-8">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide"><img
                                            src="{{ asset('asset/frontend/imgs/page/homepage1/placed.png') }}"
                                            alt="iori"></div>
                                    <div class="swiper-slide"><img
                                            src="{{ asset('asset/frontend/imgs/page/homepage1/cuebiq.png') }}"
                                            alt="iori"></div>
                                    <div class="swiper-slide"><img
                                            src="{{ asset('asset/frontend/imgs/page/homepage1/factual.png') }}"
                                            alt="iori"></div>
                                    <div class="swiper-slide"><img
                                            src="{{ asset('asset/frontend/imgs/page/homepage1/placeiq.png') }}"
                                            alt="iori"></div>
                                    <div class="swiper-slide"><img
                                            src="{{ asset('asset/frontend/imgs/page/homepage1/airmeet.png') }}"
                                            alt="iori"></div>
                                    <div class="swiper-slide"><img
                                            src="{{ asset('asset/frontend/imgs/page/homepage1/spen.png') }}" alt="iori">
                                    </div>
                                    <div class="swiper-slide"><img
                                            src="{{ asset('asset/frontend/imgs/page/homepage1/klippa.png') }}"
                                            alt="iori"></div>
                                    <div class="swiper-slide"><img
                                            src="{{ asset('asset/frontend/imgs/page/homepage1/matrix.png') }}"
                                            alt="iori"></div>
                                </div>
                                <div class="swiper-pagination swiper-pagination-group-8"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section mt-100">
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-lg-8 col-md-8">
                        <h2 class="color-brand-5 mb-20 wow animate__animated animate__fadeInUp" data-wow-delay=".0s">What We
                            Offer</h2>
                        <p class="font-lg color-gray-500 wow animate__animated animate__fadeInUp" data-wow-delay=".02s">What
                            makes us different from others? We give holistic solutions<br class="d-none d-lg-block">with
                            strategy, design & technology.</p>
                    </div>
                    <!-- <div class="col-lg-4 col-md-4 text-md-end text-start"><a
                            class="btn btn-default font-sm-bold pl-0 wow animate__animated animate__fadeInUp"
                            data-wow-delay=".04s">Learn More
                            <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor" viewbox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg></a></div> -->
                </div>
                <div class="row mt-50">
                    <div class="col-lg-4 col-md-6 col-sm-6 wow animate__animated animate__fadeInUp" data-wow-delay=".0s">
                        <div class="card-offer hover-up">
                            <div class="card-image"><img src="{{ asset('asset/frontend/imgs/page/homepage1/cross.png') }}"
                                    alt="iori"></div>
                            <div class="card-info">
                                <h5 class="color-brand-5 mb-15">ISO-27001 Compliance Service</h5>
                                <p class="font-md color-grey-500 mb-15" style="text-align: justify;">Our ISO/IEC 27001 Information Security Management System (ISMS) Certification Compliance Service can give you an in-depth review of your organization’s current security posture, to identify any potential security risks and provide recommendations for remediation. Out team will assistance in documenting, establish and monitor technical, administrative and physical security policies, procedures and controls to meet ISMS compliance including staff trainings, internal audits for continuous improvements, and incident response support.</p>
                                <div class="box-button-offer"><a
                                        class="btn btn-default font-sm-bold pl-0 color-brand-5">Learn More
                                        <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor"
                                            viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                        <div class="card-offer hover-up">
                            <div class="card-image"><img
                                    src="{{ asset('asset/frontend/imgs/page/homepage1/cross2.png') }}" alt="iori">
                            </div>
                            <div class="card-info">
                                <h5 class="color-brand-5 mb-15">GDPR Compliance Service</h5>
                                <p class="font-md color-grey-500 mb-15" style="text-align: justify;">We offer GDPR Compliance Service to ensure your business compliance with GDPR regulations including thorough analysis of data processing activities and recommendations to cover all areas. Our service can help you implement technical and administrative controls, data encryption, data retention policies, data subject access requests, monitoring, and support to ensure an up-to-date effective GDPR compliance. Partnering with us for a peace of mind knowing that your customers' personal data is protected and your organization is fully compliant with GDPR regulations.</p>
                                <div class="box-button-offer"><a
                                        class="btn btn-default font-sm-bold pl-0 color-brand-5">Learn More
                                        <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor"
                                            viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                        <div class="card-offer hover-up">
                            <div class="card-image"><img
                                    src="{{ asset('asset/frontend/imgs/page/homepage1/cross3.png') }}" alt="iori">
                            </div>
                            <div class="card-info">
                                <h5 class="color-brand-5 mb-15">HIPAA Compliance Services</h5>
                                <p class="font-md color-grey-500 mb-15" style="text-align: justify;">Our HIPAA Compliance Service for healthcare businesses offer a comprehensive solution to ensure full compliance with all aspects of Health Insurance Portability and Accountability Act (HIPAA) federal law by securing the Protected Health Information (PHI), sensitive health data and patient privacy. Our team will conduct a detailed risk analysis with recommendations to address the vulnerabilities. We'll work with you to implement administrative, physical, and technical safeguards to secure your data, such as encryption, access controls, staff training, monitoring and support to stay updated with the regulatory changes and best practices.</p>
                                <div class="box-button-offer"><a
                                        class="btn btn-default font-sm-bold pl-0 color-brand-5">Learn More
                                        <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor"
                                            viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 wow animate__animated animate__fadeInUp" data-wow-delay=".0s">
                        <div class="card-offer hover-up">
                            <div class="card-image"><img
                                    src="{{ asset('asset/frontend/imgs/page/homepage1/cross4.png') }}" alt="iori">
                            </div>
                            <div class="card-info">
                                <h5 class="color-brand-5 mb-15">21 CFR Part-11 Compliance</h5>
                                <p class="font-md color-grey-500 mb-15" style="text-align: justify;">We offer 21 Code of Federal Regulations (CFR) Part-11 compliance service to ensure your electronic health records and signatures are US Federal law compliant. From risk assessment and processes to identify any gaps or areas for improvement, our team helps you to implement the necessary controls and procedures, user authentication, data encryption, and audit trails, to ensure compliance beside ongoing monitoring and support to ensure your compliance remains up-to-date and effective. By partnering with us, you'll have peace of mind knowing that your electronic records and signatures are secure and regulatory compliant.</p>
                                <div class="box-button-offer"><a
                                        class="btn btn-default font-sm-bold pl-0 color-brand-5">Learn More
                                        <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor"
                                            viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                        <div class="card-offer hover-up">
                            <div class="card-image"><img
                                    src="{{ asset('asset/frontend/imgs/page/homepage1/cross5.png') }}" alt="iori">
                            </div>
                            <div class="card-info">
                                <h5 class="color-brand-5 mb-15">Network Security Assessment Services</h5>
                                <p class="font-md color-grey-500 mb-15" style="text-align: justify;">Our Network Security Assessment service evaluate the security of your network infrastructure including Vulnerability scanning, Network mapping and enumeration, Firewall configuration review, Wireless network risk assessment, Network traffic analysis, Penetration testing and Log analysis using NMAP, NESUS, BURP, ZenMap, ZAP, WireShark tools.</p>
                                <div class="box-button-offer"><a
                                        class="btn btn-default font-sm-bold pl-0 color-brand-5">Learn More
                                        <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor"
                                            viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                        <div class="card-offer hover-up">
                            <div class="card-image"><img
                                    src="{{ asset('asset/frontend/imgs/page/homepage1/cross6.png') }}" alt="iori">
                            </div>
                            <div class="card-info">
                                <h5 class="color-brand-5 mb-15">Data Privacy and Protection Services</h5>
                                <p class="font-md color-grey-500 mb-15" style="text-align: justify;">Our Data Privacy and Protection service ensures security and privacy of your sensitive data covering Data classification and handling, Privacy policy development & implementation, Data breach response management, Data encryption and tokenization, Privacy impact assessment, and Consent management as per NIST, ISO-27001, ISO-27701, HIPAA, GDPR, and PCIDSS standard guidelines.</p>
                                <div class="box-button-offer"><a
                                        class="btn btn-default font-sm-bold pl-0 color-brand-5">Learn More
                                        <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor"
                                            viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section mt-50 bg-grey-80 bg-plan pt-110 pb-110">
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-lg-8 col-md-8">
                        <h2 class="color-brand-5 mb-20 wow animate__animated animate__fadeInUp" data-wow-delay=".s">Choose
                            The Best Plan</h2>
                        <p class="font-lg color-gray-500 wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                            Pick your plan.<br class="d-none d-lg-block"> Change whenever you want.</p>
                    </div>
                </div>

                <div class="row mt-50">
                    @if ($plans->isEmpty())
                        <p class="text-center">No pricing plans available at the moment.</p>
                    @else
                        @foreach ($plans as $plan)
                            <div class="col-xl-4 col-lg-6 col-md-6 wow animate__animated animate__fadeIn"
                                data-wow-delay=".{{ $loop->index }}s">
                                <div class="card-plan hover-up">

                                    <div class="card-image-plan">
                                        <div class="icon-plan bg-1">
                                            <img src="{{ asset('asset/frontend/imgs/page/pricing/' . ($plan->icon ?? 'default-icon.jpeg')) }}"
                                                alt="Plan Icon">
                                        </div>
                                        <div class="info-plan">
                                            <h5 class="color-brand-5 ">{{ $plan->name }}</h5>
                                            <p class="font-md color-grey-400">
                                                {{ $plan->description ?? 'Protect for testing' }}</p>
                                        </div>
                                    </div>

                                    <div class="box-day-trial">
                                        <span class="color-brand-5 font-lg-bold ">
                                            @if ($plan->price == 0)
                                                FREE
                                            @else
                                                ${{ $plan->price }}
                                            @endif
                                        </span>
                                        <span class="font-md color-grey-500">
                                            @if ($plan->price == 0)
                                                - 30 days trial
                                            @else
                                                - user / {{ $plan->billing_cycle }}
                                            @endif
                                        </span><br>
                                        <span class="font-xs color-grey-500">
                                            @if ($plan->price == 0)
                                                No Credit card required
                                            @elseif($plan->billing_cycle === 'yearly')
                                                Billed annually
                                            @else
                                                One-time pay
                                            @endif
                                        </span>
                                    </div>



                                    <div class="plan mt-2">
                                        <h6 class='color-brand-5 fw-500 fs-6'>No. of Standards Allow: ]
                                    </div>


                                    <div class="mt-20">
                                        @if (auth()->check())
                                            <a class="btn btn-brand-1-full hover-up"
                                                href="{{ route('user.profile', $plan->id) }}">
                                                @if ($plan->price == 0)
                                                    Try for free
                                                @else
                                                    Get Started
                                                @endif
                                                <svg class="w-6 h-6 icon-16 ml-10" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                                </svg>
                                            </a>
                                        @else
                                            <a class="btn btn-brand-1-full hover-up" href="{{ route('login') }}">
                                                Login to Continue
                                                <svg class="w-6 h-6 icon-16 ml-10" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                                </svg>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>



            </div>
        </section>

        <section class="section pt-80 mb-30 bg-faqs">
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-lg-8 col-md-8">
                        <h2 class="color-brand-5 mb-20 wow animate_animated animate_fadeInUp" data-wow-delay=".0s">
                            Frequently asked questions
                        </h2>
                        <p class="font-lg color-gray-500 wow animate_animated animate_fadeInUp" data-wow-delay=".2s">
                            Feeling inquisitive? Have a read through some of our FAQs or<br class="d-none d-lg-block">
                            contact our supporters for help
                        </p>
                    </div>
                    <div class="col-lg-4 col-md-4 text-md-end text-start wow animate_animated animate_fadeInUp"
                        data-wow-delay=".4s">
                        <!-- <a class="btn btn-default font-sm-bold pl-0">Contact Us
                            <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a> -->
                    </div>
                </div>

                <div class="row mt-50 mb-100">
                    <div class="col-xl-3 col-lg-4">
                        <div class="mt-80 text-start mb-40 wow animate_animated animate_fadeInUp" data-wow-delay=".0s">
                            <a class="btn btn-brand-1 hover-up" href="#">Contact Us</a>
                            <!-- <a class="btn btn-default font-sm-bold hover-up" href="#">Support Center
                                <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a> -->
                        </div>
                    </div>

                    <div class="col-xl-9 col-lg-8">
                        <div class="tab-content tab-content-slider">
                            <div class="tab-pane fade active show" id="tab-support" role="tabpanel"
                                aria-labelledby="tab-support">
                                <div class="accordion" id="accordionFAQ">
                                    @if ($faqs->isNotEmpty())
                                        @foreach ($faqs as $index => $faq)
                                            <div class="accordion-item wow animate_animated animate_fadeInUp"
                                                data-wow-delay=".{{ $index }}s">
                                                <h5 class="color-brand-5 accordion-header" id="heading{{ $index }}">
                                                    <button
                                                        class="accordion-button text-heading-5 {{ $index != 0 ? 'collapsed' : '' }}"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapse{{ $index }}"
                                                        aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                                        aria-controls="collapse{{ $index }}">
                                                        {{ $faq->question }}
                                                    </button>
                                                </h5>
                                                <div class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}"
                                                    id="collapse{{ $index }}"
                                                    aria-labelledby="heading{{ $index }}"
                                                    data-bs-parent="#accordionFAQ">
                                                    <div class="accordion-body">
                                                        {!! $faq->answer !!}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-center">No FAQs available at the moment.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-bottom"></div>
        </section>

        <section class="section  bg-plant">
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-lg-8 col-md-8">
                        <h2 class="color-brand-5 mb-20 wow animate__animated animate__fadeInUp" data-wow-delay=".0s">What
                            our custommers are saying</h2>
                        <p class="font-lg color-gray-500 wow animate__animated animate__fadeInUp" data-wow-delay=".0s">
                            Hear from our users who have saved thousands on their Startup<br class="d-none d-lg-block"> and
                            SaaS solution spend</p>
                    </div>
                    <div class="col-lg-4 col-md-4 text-md-end text-start"><a
                            class="btn btn-default font-sm-bold pl-0 wow animate__animated animate__fadeInUp"
                            data-wow-delay=".0s">View All
                            <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor" viewbox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg></a></div>
                </div>
                <div class="mt-50 wow animate__animated animate__fadeInUp" data-wow-delay=".0s">
                    <div class="box-swiper">
                        <div class="swiper-container swiper-group-3">
                            <div class="swiper-wrapper">
                               @foreach ($testimonials as $index => $testimonial)
                                    <div class="swiper-slide">
                                        <div class="card-testimonial-grid">
                                            <div class="box-author mb-10">
                                                <a href="#">
                                                    <img src="{{ $testimonial->image ? asset('storage/' . $testimonial->image) : asset('asset/frontend/imgs/page/homepage1/author.png') }}"
                                                        alt="{{ $testimonial->name }}">
                                                </a>
                                                <div class="author-info">
                                                    <a href="#">
                                                        <span class="color-brand-5 font-md-bold author-name">{{ $testimonial->name }}</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <p class="font-md color-grey-500">
                                                {{ $testimonial->testimonial_detail }}
                                            </p>
                                            <div class="card-bottom-info">
                                                <span class="font-xs color-grey-500 date-post">
                                                    {{ \Carbon\Carbon::parse($testimonial->created_at)->format('d F Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="swiper-pagination swiper-pagination-2 swiper-pagination-group-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section mt-50">
            <div class="container">
                <div class="box-newsletter">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-12">
                            <div class="box-image-newsletter">
                                <div class="wow animate__animated animate__zoomIn" data-wow-delay=".0s"><img
                                        class="img-main"
                                        src="{{ asset('asset/frontend/imgs/template/newsletter_img.png') }}"
                                        alt="iori"></div>
                                <div class="shape-2 image-1"><img
                                        src="{{ asset('asset/frontend/imgs/template/newsletter_finger.png') }}"
                                        alt="iori"></div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12"><span
                                class="font-lg color-brand-5 wow animate__animated animate__fadeIn"
                                data-wow-delay=".0s">Newsletter</span>
                            <h2 class="color-brand-5 mb-15 mt-5 wow animate__animated animate__fadeIn"
                                data-wow-delay=".1s">Subcribe our newsletter</h2>
                            <p class="font-md color-grey-500 wow animate__animated animate__fadeIn" data-wow-delay=".2s">
                                By clicking the button, you are agreeing with our Term & Conditions</p>
                            <div class="form-newsletter mt-30 wow animate__animated animate__fadeIn" data-wow-delay=".3s">
                                <form action="#">
                                    <input type="text" placeholder="Enter you mail ..">
                                    <button class="btn btn-submit-newsletter" type="submit">
                                        <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor"
                                            viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
