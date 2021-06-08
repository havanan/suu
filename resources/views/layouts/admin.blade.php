<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('images/suu-kids.png')}}">
    <title> @yield('title') </title>
    <!-- Styles -->
    <link href="{{ asset('assets/admin/css/lib.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('css')
</head>
<body>
    <!--wrapper-->
    <div id="app" class="wrapper">
        <!--start header -->
        <!--start header -->
            @includeIf('manager.lib.header')
        <!--end header -->
        <!--navigation-->
        <!--sidebar wrapper -->
            @includeIf('manager.lib.sidebar')
        <!--end sidebar wrapper -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <!--breadcrumb-->
                @includeIf('manager.lib.breadcrumb')
                <!--end breadcrumb-->
                <div class="card">
                    <div class="card-body p-4">
{{--                        <h5 class="card-title">Add New Product</h5>--}}
{{--                        <hr/>--}}
                        <div class="form-body mt-4">
                            @yield('content')
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
            <p class="mb-0">Copyright © 2021. All right reserved.</p>
        </footer>
    </div>
    <!--end wrapper-->
    <!--start switcher-->
        @includeIf('manager.lib.switcher')
    <!--end switcher-->
    <script src="{{ asset('assets/admin/js/lib.js') }}" defer></script>
    @includeIf('layouts.flash_message')
    @yield('js')

</body>
</html>
