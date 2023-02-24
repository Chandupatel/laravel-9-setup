<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark"
    data-sidebar-size="lg" data-sidebar-image="none" data-preloader="enable">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    {{-- Theme  Assets --}}
    <link rel="shortcut icon" href="{{ asset('admin/images/favicon.ico') }}">
    <script src="{{ asset('admin/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('admin/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <!-- select2 Css-->
    <link href="{{ asset('admin/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    {{-- bootstrap4 toggle --}}
    <link rel="stylesheet" href="{{ asset('admin/libs/bootstrap4-toggle/bootstrap4-toggle.min.css') }}">

    <link href="{{ asset('admin/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet" type="text/css" />
    @yield('pagecss')
    <style>
    </style>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script>
        var base_url = '{{ url('/') }}';
    </script>
</head>

<body>

    <div id="layout-wrapper">
        <toaster-container toaster-options="{'time-out': 5000}"></toaster-container>
        @include('layouts.admin.header')
        <!-- ========== App Menu ========== -->
        @include('layouts.admin.sidebar')
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    {{--  --}}
                    <!-- end page title -->
                    @yield('content')

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @include('layouts.admin.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->
    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>


    <script type="text/javascript" src="{{ asset('admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/libs/simplebar/simplebar.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/libs/node-waves/waves.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/libs/feather-icons/feather.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/plugins.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('admin/libs/select2/select2.min.js') }}"></script>
    {{-- bootstrap4 toggle --}}
    <script src="{{ asset('admin/libs/bootstrap4-toggle/bootstrap4-toggle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/admin.js') }}"></script>
    @include('layouts/notification')

    @yield('scripts')
</body>
</html>
