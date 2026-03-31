

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Compliance Management System</title>
  <link rel="icon" type="image/png" href="{{asset('asset/backend/images/favicon.png')}}" sizes="16x16">
  <!-- remix icon font css  -->
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
            <img src="{{ asset('asset/backend/images/auth/auth-img.jpg') }}" alt="">
        </div>
    </div>
    <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
        <div class="max-w-464-px mx-auto w-100">
            <div class="text-center">
                <a href="{{ url('/') }}" class="mb-40 max-w-290-px">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="">
                </a>
                <h4 class="mb-12">Confirm Password</h4>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            {{ __('Please confirm your password before continuing.') }}


                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div class="form-floating mb-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" value="{{ $password ?? old('password') }}" required autocomplete="password" autofocus>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label for="password">Password</label>
                    </div>


                    <button type="submit" class="btn btn-primary py-3 w-100 mb-4">
                        {{ __('Confirm Password') }}
                    </button>

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

