<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Auth Suukids</title>
    <!-- Styles -->
    <link href="{{ asset('assets/admin/css/lib.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->

</head>
<body class="bg-login">
<!--wrapper-->
<div class="wrapper">
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col mx-auto">
                    <div class="mb-4 text-center">
                        <img src="{{asset('images\logo.png')}}" width="180" alt="" />
                    </div>
                    @if($errors->has('error'))
                        <p class="text-danger">
                            {{ $errors->first('error') }}
                        </p>
                    @endif
                    @yield('content')
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
</div>
<!--end wrapper-->
<script src="{{ asset('assets/admin/js/lib.js') }}"></script>
{{--@includeIf('layouts.flash_message')--}}
</body>
</html>
