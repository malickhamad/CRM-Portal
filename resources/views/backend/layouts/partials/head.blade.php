@include('backend.layouts.partials.meta')



  <!-- favicon  -->
<link rel="icon" type="image/png" sizes="32x32"
      href="{{ isset($siteSettings['favicon']) ? asset('storage/' . $siteSettings['favicon']) : asset('asset/backend/images/fivestarlogo.png') }}">


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
  <link rel="stylesheet" href="{{asset('asset/backend/css/dashboard.css')}}">


    <!-- main js -->



</head>

  <body>

<script>
    WebFont.load({
        google: {
            families: ["Public Sans:300,400,500,600,700"]
        },
        custom: {
            families: [
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ["{{ asset('asset/backend/js/plugin/webfont/webfont.min.js') }}"],
        },
        active: function() {
            sessionStorage.fonts = true;
        },
    });
</script>
@stack('custom-css')
