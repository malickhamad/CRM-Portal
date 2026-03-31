

 {{-- for mobile header --}}



      <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="msapplication-TileColor" content="#0E0E0E">
    <meta name="template-color" content="#0E0E0E">
    <meta name="description" content="Index page">
    <meta name="keywords" content="index, page">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="32x32"
    href="{{ isset($siteSettings['favicon']) ? asset('storage/' . $siteSettings['favicon']) : asset('asset/backend/images/fivestarlogo.png') }}">    <link href="{{ asset('asset/frontend/css/style.css?v=5.0.0') }}" rel="stylesheet">
    <title>{{ $siteSettings['site_title'] ?? 'Five Star Solutions' }}</title>
</head>

<body>
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="page-loading">
                    <div class="page-loading-inner">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>



      <section class="section box-404">
        <div class="container">
          <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-10">
              <div class="row align-items-center">
                <div class="col-md-5 col-sm-12 mb-30 text-center text-md-start"><img src="{{ asset('asset/frontend//imgs/page/404/405.png') }}" alt="iori"></div>
                <div class="col-md-7 col-sm-12 text-center text-md-start">
                  <h1 class="color-brand-1 font-84 mb-10 wow animate__animated animate__fadeIn" data-wow-delay=".0s">403</h1>
                  <h3 class="color-brand-1 mb-25 wow animate__animated animate__fadeIn" data-wow-delay=".1s"> Unauthorized Action</h3>
                  <p class="font-md color-grey-500 wow animate__animated animate__fadeIn" data-wow-delay=".2s">Your account does not have the required permissions to perform this action. Please reach out to your system administrator to request access.</p>
                  <div class="mt-50 wow animate__animated animate__fadeIn" data-wow-delay=".3s"><a class="btn btn-brand-1 color-white-900 pl-0" href="javascript:history.back();">
                      <svg class="w-6 h-6 icon-16 mr-5" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                      </svg>Back</a></div>
                </div>
              </div>
            </div>
          </div>
          <div class="border-bottom bd-grey-80 mt-110 mb-0"></div>
        </div>
      </section>


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
