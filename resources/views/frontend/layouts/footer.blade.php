<footer class="footer">
    <div class="footer-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 width-20">
                           <div class="header-logo-footer"><a class="d-flex" href="{{ route('frontend.home') }}">
                        <img style="object-fit:contain;" src="{{ isset($siteSettings['site_logo']) && file_exists(storage_path('app/public/' . $siteSettings['site_logo'])) ? asset('storage/' . $siteSettings['site_logo']) : asset('asset/backend/images/fivestarlogo.png') }}"
                        alt="Site Logo" height="70" width="300">                            </a>
                        </div>
                    <p class="font-md mb-20 color-grey-400">
                        {{ $siteSettings['street_address'] ?? 'Default Address: 1234 Default St., Default City, Country 00000' }}
                    </p>
                    <div class="font-md mb-20 color-grey-400"><strong class="font-md-bold">Hours:</strong> 8:00 AM - 06:00 PM EST,
                        Mon - Sat</div>
                    <h6 class="color-brand-5">Follow Us</h6>
                    <div class="mt-15"><a class="icon-socials icon-facebook" href="#"></a><a
                            class="icon-socials icon-instagram" href="#"></a><a class="icon-socials icon-twitter"
                            href="#"></a><a class="icon-socials icon-linkedin" href="#"></a><a
                            class="icon-socials icon-youtube" href="#"></a></div>
                </div>
                <div class="col-lg-3 width-16 mb-30">
                    <h5 class="mb-10 color-brand-5">About Us</h5>
                    <ul class="menu-footer">
                        <li><a href="about.html">Mission &amp; Vision</a></li>
                        <li><a href="team.html">Our Team</a></li>
                        <li><a href="#">News & Events</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">Testimonials</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 width-16 mb-30">
                    <h5 class="mb-10 color-brand-5">Ressources</h5>
                    <ul class="menu-footer">
                        <li><a href="#">HIPAA Compliance for AWS</a></li>
                        <li><a href="#">HIPAA Compliant Software Development</a></li>
                        <li><a href="#">HIPAA Compliant Hosting</a></li>

                    </ul>
                </div>
                <div class="col-lg-3 width-16 mb-30">
                    <h5 class="mb-10 color-brand-5">We offer</h5>
                    <ul class="menu-footer">
                        <li><a href="#">Network Security Assessment Services</a></li>
                        <li><a href="#">Data Privacy and Protection Services</a></li>
                        <li><a href="#">Cloud Security Services</a></li>
                        <li><a href="#">Vulnerability Assessment and Penetration Testing</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 width-23">
                    <h5 class="mb-10 color-brand-5">We offer</h5>
                    <ul class="menu-footer">
                
                        <li><a href="#">Mobile Application Security Services</a></li>
                        <li><a href="#">Ransomware Recovery Service</a></li>
                        <li><a href="#">Computer/Digital Forensics Analysis</a></li>
                        <li><a href="#">Security Awareness Training</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-2">
        <div class="container">
            <div class="footer-bottom">
                <div class="row">
                    <div class="col-lg-6 col-md-12 text-center text-lg-start">
                        <ul class="menu-bottom">
                            <li><a class="font-sm color-grey-300" href="">Privacy policy</a></li>
                            <li><a class="font-sm color-grey-300" href="">Cookies</a></li>
                            <li><a class="font-sm color-grey-300" href="">Terms of service</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-12 text-center text-lg-end"><span class="color-grey-300 font-md">© Five Star Solution
                            Official 2025. All right reversed.</span></div>
                </div>
            </div>
        </div>
    </div>
</footer>


<script src="{{ asset('asset/frontend/js/vendors/modernizr-3.6.0.min.js') }}"></script>
<script src="{{ asset('asset/frontend/js/vendors/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('asset/frontend/js/vendors/jquery-migrate-3.3.0.min.js') }}"></script>
<script src="{{ asset('asset/frontend/js/vendors/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('asset/frontend/js/vendors/waypoints.js') }}"></script>
<script src="{{ asset('asset/frontend/js/vendors/wow.js') }}"></script>
<script src="{{ asset('asset/frontend/js/vendors/magnific-popup.js') }}"></script>
<script src="{{ asset('asset/frontend/js/vendors/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('asset/frontend/js/vendors/select2.min.js') }}"></script>
<script src="{{ asset('asset/frontend/js/vendors/isotope.js') }}"></script>
<script src="{{ asset('asset/frontend/js/vendors/scrollup.js') }}"></script>
<script src="{{ asset('asset/frontend/js/vendors/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('asset/frontend/js/vendors/noUISlider.js') }}"></script>
<script src="{{ asset('asset/frontend/js/vendors/slider.js') }}"></script>
<!-- Count down-->
<script src="{{ asset('asset/frontend/js/vendors/counterup.js') }}"></script>
<script src="{{ asset('asset/frontend/js/vendors/jquery.countdown.min.js') }}"></script>
<!-- Count down-->
<script src="{{ asset('asset/frontend/js/vendors/jquery.elevatezoom.js') }}"></script>
<script src="{{ asset('asset/frontend/js/vendors/slick.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
<script src="{{ asset('asset/frontend/js/main.js?v=5.0.0') }}"></script>
<script src="{{ asset('asset/frontend/js/ali-animation.js?v=1.0.0') }}"></script>

</body>

</html>
