@extends('frontend.layouts.app')


@section('content')




    <main class="main ">
      <section class="section banner-service bg-grey-60  position-relative">
       <div class="box-banner-abs ">
          <div class="container ">
            <div class="row align-items-center">
              <div class="col-xxl-6 col-lg-7 col-lg-12">
                <div class="box-banner-service ">
                  <h1 class="color-brand-1 mb-2 wow animate__animated animate__fadeIn" data-wow-delay=".0s">Advanced<br class="d-none d-xxl-block">analytics to grow your business</h1>
                  <div class="row">
                    <div class="col-lg-9">
                      <p class="font-md color-grey-500 wow animate__animated animate__fadeIn" data-wow-delay=".2s">Collaborate, plan projects and manage resources with powerful features that your whole team can use.  The latest news, tips and advice to help you run your business with less fuss.</p>
                    </div>
                  </div>
                  <div class="mt-30 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                    <h5 class="color-brand-1 d-none">Available on</h5>
                  </div>
                  <div class="box-button mt-20 d-none"><a class="btn-app mb-15 hover-up" href="#"><img src="{{asset('asset/frontend/imgs/template/appstore-btn.png')}}" alt="iori"></a><a class="btn-app mb-15 hover-up" href="#"><img src="{{asset('asset/frontend/imgs/template/google-play-btn.png')}}" alt="iori"></a><a class="btn btn-default mb-15 pl-10 font-sm-bold hover-up" href="#">Learn More
                      <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                      </svg></a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row m-0">
          <div class="col-xxl-5 col-xl-7 col-lg-6"></div>
          <div class="col-xxl-7 col-xl-5 col-lg-6 pr-0">
            <div class="d-none d-xxl-block pl-70">
              <div class="img-reveal"><img class="w-100 d-block" src="{{asset('asset/frontend/imgs/page/service/banner.png')}}" alt="iori"></div>
            </div>
          </div>
        </div>
      </section>
      <section class="section mt-100">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 text-center">
              <h2 class="color-brand-1 mb-20 wow animate__animated animate__fadeIn" data-wow-delay=".0s">What We Offer</h2>
              <p class="font-lg color-gray-500 wow animate__animated animate__fadeIn" data-wow-delay=".2s">What makes us different from others? We give holistic solutions<br class="d-none d-lg-block">with strategy, design & technology.</p>
            </div>
          </div>
          <div class=" mt-50 wow animate__animated animate__fadeIn" data-wow-delay=".0s">
            
            <!-- <div class="box-swiper">
              <div class="swiper-container swiper-group-4">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <div class="card-offer-style-3">
                      <div class="card-head">
                        <div class="card-image"><img src="{{asset('asset/frontend/imgs/page/homepage1/cross.png')}}" alt="iori"></div>
                        <div class="carrd-title">
                          <h5 class="color-brand-1">ISO-27001 Compliance Service</h5>
                        </div>
                      </div>
                      <div class="card-info">
                        <p class="font-sm color-grey-500 mb-15">Our ISO/IEC 27001 Information Security Management System (ISMS) Certification Compliance Service can give you an in-depth review of your organization’s current security posture, to identify any potential security risks and provide recommendations for remediation. Out team will assistance in documenting, establish and monitor technical, administrative and physical security policies, procedures and controls to meet ISMS compliance including staff trainings, internal audits for continuous improvements, and incident response support.</p>
                        <div class="box-button-offer"><a class="btn btn-default font-sm-bold pl-0 color-brand-1 hover-up">Learn More
                            <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg></a></div>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide head-bg-brand-2">
                    <div class="card-offer-style-3">
                      <div class="card-head">
                        <div class="card-image"><img src="{{asset('asset/frontend/imgs/page/homepage1/cross2.png')}}" alt="iori"></div>
                        <div class="carrd-title">
                          <h5 class="color-brand-1">Business strategy</h5>
                        </div>
                      </div>
                      <div class="card-info">
                        <p class="font-sm color-grey-500 mb-15">Discover powerful features to boost your productivit. You are always welcome to visit our little den. Professional in teir craft! All products were super amazing with strong attension to details, comps and overall vibe.</p>
                        <div class="box-button-offer"><a class="btn btn-default font-sm-bold pl-0 color-brand-1 hover-up">Learn More
                            <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg></a></div>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide head-bg-2">
                    <div class="card-offer-style-3">
                      <div class="card-head">
                        <div class="card-image"><img src="{{asset('asset/frontend/imgs/page/homepage1/business.svg')}}" alt="iori"></div>
                        <div class="carrd-title">
                          <h5 class="color-brand-1">GDPR Compliance Service</h5>
                        </div>
                      </div>
                      <div class="card-info">
                        <p class="font-sm color-grey-500 mb-15">We offer GDPR Compliance Service to ensure your business compliance with GDPR regulations including thorough analysis of data processing activities and recommendations to cover all areas. Our service can help you implement technical and administrative controls, data encryption, data retention policies, data subject access requests, monitoring, and support to ensure an up-to-date effective GDPR compliance. Partnering with us for a peace of mind knowing that your customers' personal data is protected and your organization is fully compliant with GDPR regulations.</p>
                        <div class="box-button-offer"><a class="btn btn-default font-sm-bold pl-0 color-brand-1 hover-up">Learn More
                            <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg></a></div>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide head-bg-5">
                    <div class="card-offer-style-3">
                      <div class="card-head">
                        <div class="card-image"><img src="{{asset('asset/frontend/imgs/page/homepage1/cross4.png')}}" alt="iori"></div>
                        <div class="carrd-title">
                          <h5 class="color-brand-1">HIPAA Compliance Services</h5>
                        </div>
                      </div>
                      <div class="card-info">
                        <p class="font-sm color-grey-500 mb-15">Our HIPAA Compliance Service for healthcare businesses offer a comprehensive solution to ensure full compliance with all aspects of Health Insurance Portability and Accountability Act (HIPAA) federal law by securing the Protected Health Information (PHI), sensitive health data and patient privacy. Our team will conduct a detailed risk analysis with recommendations to address the vulnerabilities. We'll work with you to implement administrative, physical, and technical safeguards to secure your data, such as encryption, access controls, staff training, monitoring and support to stay updated with the regulatory changes and best practices.</p>
                        <div class="box-button-offer"><a class="btn btn-default font-sm-bold pl-0 color-brand-1 hover-up">Learn More
                            <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg></a></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-button-slider-bottom">
                  <div class="swiper-button-prev swiper-button-prev-group-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                  </div>
                  <div class="swiper-button-next swiper-button-next-group-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                  </div>
                </div>
              </div>
            </div> -->
            <div class="row">
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
                    <div class="col-lg-4 col-md-6 col-sm-6 wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                        <div class="card-offer hover-up">
                            <div class="card-image"><img
                                    src="{{ asset('asset/frontend/imgs/page/homepage1/cross6.png') }}" alt="iori">
                            </div>
                            <div class="card-info">
                                <h5 class="color-brand-5 mb-15">Cloud Security Services</h5>
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
                    <div class="col-lg-4 col-md-6 col-sm-6 wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                        <div class="card-offer hover-up">
                            <div class="card-image"><img
                                    src="{{ asset('asset/frontend/imgs/page/homepage1/cross6.png') }}" alt="iori">
                            </div>
                            <div class="card-info">
                                <h5 class="color-brand-5 mb-15">Vulnerability Assessment and Penetration Testing</h5>
                                <p class="font-md color-grey-500 mb-15" style="text-align: justify;">We offer top quality Vulnerability Assessment and Penetration Testing to identify, assess and secure the vulnerabilities in your information systems and applications inclduing Vulnerability scanning & Penetration Testing, Configuration review, Network assessment, Social engineering testing using tools like NMAP, NESUS, BURP, ZenMap, ZAP, WireShark, Accunetix, Nikto, Metasploit, Sqlmap, Hydra, Durbuster, SubLister,Nuclei, and John The Ripper.</p>
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
                                <h5 class="color-brand-5 mb-15">Mobile Application Security Services</h5>
                                <p class="font-md color-grey-500 mb-15">Our Mobile Application Security Service ensures the security of your mobile applications and data including Mobile Application penetration testing, API Security assessment, Reverse engineering, Code Review, Secure Coding Policy and guidelines using Genemotion, BurpSuit, ZAP and other tools.</p>
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
                                <h5 class="color-brand-5 mb-15">Ransomware Recovery Service</h5>
                                <p class="font-md color-grey-500 mb-15" style="text-align: justify;">Our Ransomware Recovery Service can help you get your data back fast and securely to get your business back up and running after ransomware or malware attack. We have a team of experienced engineers who are experts in ransomware decryption using recovery tools and techniques like File carving, Disk imaging, Data recovery software, and Cloud-based decryption tools.</p>
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
                                <h5 class="color-brand-5 mb-15">Computer/Digital Forensics Analysis</h5>
                                <p class="font-md color-grey-500 mb-15">Our Computer/Digital Forensics Service can help you collect and analyze digital evidence from a wide variety of devices, including computers, laptops, smartphones, tablets, and even network traffic. We use a variety of tools and techniques to ensure that our investigations are thorough and accurate in compliance with legal frameworks like Federal Rules of Civil Procedure and the Electronic Discovery Reference Model.</p>
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
                                <h5 class="color-brand-5 mb-15">Security Awareness Training</h5>
                                <p class="font-md color-grey-500 mb-15" style="text-align: justify;">Our Security Awareness Training can help you educate employees and stakeholders on modern day cybersecurity threats and best practices with digital content covering Phishing awareness training, Social engineering training, Password security training, Secure coding training, Security policy awareness deliverable through Coursera, Video, Slides, Read-out emails.</p>
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
        </div>
      </section>
      <section class="section mt-50">
        <div class="container">
          <div class="box-business-rd">
            <div class="row align-items-center">
              <div class="col-lg-5"><span class="btn btn-tag wow animate__animated animate__fadeIn" data-wow-delay=".0s">Business</span>
                <h3 class="color-brand-1 mt-10 mb-15 wow animate__animated animate__fadeIn" data-wow-delay=".0s">Integrate with over 1,000 project management apps</h3>
                <p class="font-md color-grey-400 wow animate__animated animate__fadeIn" data-wow-delay=".0s">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit laborum — semper quis lectus nulla. Interactively transform magnetic growth strategies whereas prospective "outside the box" thinking.</p>
                <div class="mt-20">
                  <ul class="list-ticks">
                    <li>
                      <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>Task tracking
                    </li>
                    <li>
                      <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>Create task dependencies
                    </li>
                    <li>
                      <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>Task visualization
                    </li>
                    <li>
                      <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>hare files, discuss
                    </li>
                    <li>
                      <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>Meet deadlines faster
                    </li>
                    <li>
                      <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>Track time spent on each project
                    </li>
                  </ul>
                </div>
                <div class="mt-50 text-start wow animate__animated animate__fadeIn" data-wow-delay=".0s"><a class="btn btn-brand-1 hover-up" href="#">Download App</a><a class="btn btn-default font-sm-bold hover-up" href="#">Learn More
                    <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg></a></div>
              </div>
              <div class="col-lg-7 wow animate__animated animate__fadeIn" data-wow-delay=".0s">
                <div class="box-business-service">
                  <div class="box-number-1 shape-2">
                    <div class="cardNumber bg-white">
                      <h3>25k+</h3>
                      <p class="font-xs color-brand-1">Happy Clients</p>
                    </div>
                  </div>
                  <div class="box-image-1 shape-3"><img src="{{asset('asset/frontend/imgs/page/service/img1.png')}}" alt="iori"></div>
                  <div class="box-image-2 shape-2"><img src="{{asset('asset/frontend/imgs/page/service/img2.png')}}" alt="iori"></div>
                  <div class="box-image-3 shape-1"><img src="{{asset('asset/frontend/imgs/page/service/img4.png')}}" alt="iori">
                    <div class="cardNumber bg-white">
                      <h2 class="color-brand-1"><span class="count">469</span><span>k</span></h2>
                      <p class="font-lg color-brand-1">Social followers</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

   
      <section class="section mt-50">
        <div class="container">
          <div class="box-newsletter box-newsletter-2 wow animate__animated animate__fadeIn">
            <div class="row align-items-center">
              <div class="col-lg-8 col-md-8 m-auto text-center"><span class="font-lg color-brand-1 wow animate__animated animate__fadeIn" data-wow-delay=".0s">Newsletter</span>
                <h2 class="color-brand-1 mb-15 mt-5 wow animate__animated animate__fadeIn" data-wow-delay=".1s">Subcribe our newsletter</h2>
                <p class="font-md color-grey-500 wow animate__animated animate__fadeIn" data-wow-delay=".2s">Do not miss the latest information from us about the trending in the market. By clicking the button, you are agreeing with our Term & Conditions</p>
                <div class="form-newsletter mt-30 wow animate__animated animate__fadeIn" data-wow-delay=".3s">
                  <form action="#">
                    <input type="text" placeholder="Enter you mail ..">
                    <button class="btn btn-submit-newsletter" type="submit">
                      <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
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
