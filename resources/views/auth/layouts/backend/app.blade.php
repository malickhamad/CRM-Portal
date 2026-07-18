<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('auth.layouts.backend.partials.head')
</head>

<body>

    <div id="app" class="container-fluid position-relative d-flex p-0">
        @include('auth.layouts.backend.partials.loader')
        @yield('content')
    </div>

    @include('auth.layouts.backend.partials.script')

</body>

</html>
