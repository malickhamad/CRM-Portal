

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="icon" type="image/png" sizes="32x32"
    href="{{ isset($siteSettings['favicon']) ? asset('storage/' . $siteSettings['favicon']) : asset('asset/backend/images/fivestarlogo.png') }}">    <link href="{{ asset('asset/frontend/css/style.css?v=5.0.0') }}" rel="stylesheet">
    <title>{{ $siteSettings['site_title'] ?? 'Five Star Solutions' }}</title>  <!-- remix icon font css  -->
  <link rel="stylesheet" href="{{asset('asset/backend/css/remixicon.css')}}">
  <!-- BootStrap css -->
  <link rel="stylesheet" href="{{asset('asset/backend/css/lib/bootstrap.min.css')}}">
  <!-- Apex Chart css -->
  <link rel="stylesheet" href="{{asset('asset/backend/css/lib/apexcharts.css')}}">
  <!-- Data Table css -->
  <link rel="stylesheet" href="{{asset('asset/backend/css/lib/dataTables.min.css')}}">

  <!-- Text Editor css -->
  <link rel="stylesheet" href="{{asset('asset/backend/css/lib/editor-katex.min.css')}}">
  <link rel="stylesheet" href="{{asset('asset/backend/css/lib/editor.atom-one-dark.min.css')}}">
  <link rel="stylesheet" href="{{asset('asset/backend/css/lib/editor.quill.snow.css')}}">
  <!-- Date picker css -->
  <link rel="stylesheet" href="{{asset('asset/backend/css/lib/flatpickr.min.css')}}">
  <!-- Calendar css -->
  <link rel="stylesheet" href="{{asset('asset/backend/css/lib/full-calendar.css')}}">
  <!-- Vector Map css -->
  <link rel="stylesheet" href="{{asset('asset/backend/css/lib/jquery-jvectormap-2.0.5.css')}}">
  <!-- Popup css -->
  <link rel="stylesheet" href="{{asset('asset/backend/css/lib/magnific-popup.css')}}">
  <!-- Slick Slider css -->
  <link rel="stylesheet" href="{{asset('asset/backend/css/lib/slick.css')}}">
  <!-- prism css -->
  <link rel="stylesheet" href="{{asset('asset/backend/css/lib/prism.css')}}">
  <!-- file upload css -->
  <link rel="stylesheet" href="{{asset('asset/backend/css/lib/file-upload.css')}}">

  <link rel="stylesheet" href="{{asset('asset/backend/css/lib/audioplayer.css')}}">
  <!-- main css -->
  <link rel="stylesheet" href="{{asset('asset/backend/css/style.css')}}">
    <!-- main js -->

</head>
  <body>

<!-- Sign In Start -->
<section class="auth bg-base d-flex flex-wrap">
    <div class="auth-left d-lg-block d-none">
        <div class="d-flex align-items-center flex-column h-100 justify-content-center">
            <img src="{{asset('asset/backend/images/auth/auth-img.jpg')}}" alt="">
        </div>
    </div>
    <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
        <div class="max-w-464-px mx-auto w-100">
            <div>
                <a href="index.html" class="mb-40 max-w-290-px">
                    <img src="assets/images/logo.png" alt="">
                </a>
                <h4 class="mb-12">Sign Up to your Account</h4>
                <p class="mb-32 text-secondary-light text-lg">Welcome back! please enter your detail</p>
            </div>
            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="icon-field mb-16">
                    <span class="icon top-50 translate-middle-y">
                        <iconify-icon icon="f7:person"></iconify-icon>
                    </span>
                    <input type="text" name="name" class="form-control h-56-px bg-neutral-50 radius-12" placeholder="Username" required>
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="icon-field mb-16">
                    <span class="icon top-50 translate-middle-y">
                        <iconify-icon icon="mage:email"></iconify-icon>
                    </span>
                    <input type="email" name="email" class="form-control h-56-px bg-neutral-50 radius-12" placeholder="Email" required>
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-20">
                    <div class="position-relative">
                        <div class="icon-field">
                            <span class="icon top-50 translate-middle-y">
                                <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                            </span>
                            <input type="password" name="password" class="form-control h-56-px bg-neutral-50 radius-12" id="your-password" placeholder="Password" required>
                        </div>
                        <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password"></span>
                    </div>

                </div>

                <div class="mb-20">
                    <div class="position-relative">
                        <div class="icon-field">
                            <span class="icon top-50 translate-middle-y">
                                <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                            </span>
                            <input type="password" name="password_confirmation" class="form-control h-56-px bg-neutral-50 radius-12" id="confirm-password" placeholder="Confirm Password" required>
                        </div>
                    </div>
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- <div class="form-check style-check d-flex align-items-start">
                    <input class="form-check-input border border-neutral-300 mt-4" type="checkbox" name="terms" id="condition" required>
                    <label class="form-check-label text-sm" for="condition">
                        By creating an account, you agree to the
                        <a href="javascript:void(0)" class="text-primary-600 fw-semibold">Terms & Conditions</a> and our
                        <a href="javascript:void(0)" class="text-primary-600 fw-semibold">Privacy Policy</a>
                    </label>
                </div> --}}

                <button type="submit" class="btn btn-brand-1-full text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32"> Sign Up</button>

                <div class="mt-32 text-center text-sm">
                    <p class="mb-0">Already have an account? <a href="{{ route('login') }}" class=" fw-semibold color-brand-1">Sign In</a></p>
                </div>
            </form>


        </div>
    </div>
</section>

<!-- Sign In End -->
<!-- jQuery library js -->
<script src="{{asset('asset/backend/js/lib/jquery-3.7.1.min.js')}}"></script>
  <!-- Bootstrap js -->
  <script src="{{asset('asset/backend/js/lib/bootstrap.bundle.min.js')}}"></script>
  <!-- Apex Chart js -->
  <script src="{{asset('asset/backend/js/lib/apexcharts.min.js')}}"></script>
  <!-- Data Table js -->
  <script src="{{asset('asset/backend/js/lib/dataTables.min.js')}}"></script>
  <!-- Iconify Font js -->
  <script src="{{asset('asset/backend/js/lib/iconify-icon.min.js')}}"></script>
  <!-- jQuery UI js -->
  <script src="{{asset('asset/backend/js/lib/jquery-ui.min.js')}}"></script>
  <!-- Vector Map js -->
  <script src="{{asset('asset/backend/js/lib/jquery-jvectormap-2.0.5.min.js')}}"></script>
  <script src="{{asset('asset/backend/js/lib/jquery-jvectormap-world-mill-en.js')}}"></script>
  <!-- Popup js -->
  <script src="{{asset('asset/backend/js/lib/magnifc-popup.min.js')}}"></script>
  <!-- Slick Slider js -->
  <script src="{{asset('asset/backend/js/lib/slick.min.js')}}"></script>
  <!-- prism js -->
  <script src="{{asset('asset/backend/js/lib/prism.js')}}"></script>
  <!-- file upload js -->
  <script src="{{asset('asset/backend/js/lib/file-upload.js')}}"></script>
  <!-- audioplayer -->
  <script src="{{asset('asset/backend/js/lib/audioplayer.js')}}"></script>

  <!-- main js -->
  <script src="{{asset('asset/backend/js/app.js')}}"></script>

<script src="{{asset('asset/backend/js/homeTwoChart.js')}}"></script>
<script>
      // ================== Password Show Hide Js Start ==========
      function initializePasswordToggle(toggleSelector) {
        $(toggleSelector).on('click', function() {
            $(this).toggleClass("ri-eye-off-line");
            var input = $($(this).attr("data-toggle"));
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    }
    // Call the function
    initializePasswordToggle('.toggle-password');
  // ========================= Password Show Hide Js End ===========================
</script>
</body>
</html>
