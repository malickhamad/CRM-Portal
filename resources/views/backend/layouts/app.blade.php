<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('backend.layouts.partials.head')
</head>

<body>


    @include('backend.layouts.partials.sidebar')

    @yield('content')
    {{-- @include('backend.layouts.partials.back_to_top_arrow') --}}




    @include('backend.layouts.partials.footer')

    @include('backend.layouts.partials.script')


</body>
</html>
