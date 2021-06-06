<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Auth Suukids</title>
    <!-- Fonts -->
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

    <!-- Styles -->
    <link href="{{ asset('assets/admin/css/lib.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}
    <script src="{{ asset('assets/admin/js/lib.js') }}" defer></script>
    @includeIf('layouts.flash_message')
</head>
<body>
<div class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">

            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
