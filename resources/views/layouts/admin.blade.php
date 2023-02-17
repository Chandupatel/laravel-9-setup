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
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
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
    @include('layouts/notification')

    <script type="text/javascript">
        $(".select2").select2();

        function checkRequiredValidation(form_id) {
            var is_invalid_input = 0;
            $('.error-span').text('');
            $('.form-control').removeClass('is-invalid');
            $(form_id).find('.form-control').each(function() {
                var required_attr = $(this).attr('required');
                if (typeof required_attr !== typeof undefined && required_attr !== false) {
                    if (!$(this).val()) {
                        is_invalid_input = 1
                        var input_name = $(this).attr('name');
                        input_name = input_name.replace("_", " ");
                        // input_name = input_name.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                        //     return letter.toUpperCase();
                        // });
                        $(this).addClass('is-invalid');
                        $('#error_' + $(this).attr('name')).text('The ' + input_name + ' field is required.');
                    }
                }
            })
            if (is_invalid_input == 1) {
                return false;
            } else {
                return true;
            }
        }

        function callPostAjax(url, form_id, reload_page, succrss_redirect = 0, succrss_redirect_url = '') {
            if (checkRequiredValidation(form_id)) {
                $(".form-control").removeClass("is-invalid");
                $('.error-span').text('');
                $.ajax({
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    method: 'post',
                    data: new FormData($(form_id)[0]),
                    beforeSend: function() {
                        $("#preloader").show();
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#preloader').hide();
                        if (response.status == true) {
                            $(form_id).trigger("reset");
                            if (succrss_redirect == 1) {
                                window.location.href = succrss_redirect_url;
                            } else if (reload_page == 1) {
                                toastr.success('Success', response.message, {
                                    timeOut: 5000
                                });
                                window.location.reload();
                            }
                        } else if (response.status == 'validator_error') {
                            $.each(response.errors, function(index, html) {
                                $(form_id).find('input[name="' + index + '"]').addClass(
                                    'is-invalid');
                                $('#error_' + index).text(html);
                            });
                        } else {
                            toastr.error('Error', response.message, {
                                timeOut: 5000
                            });
                        }
                    }
                });
            }
        }

        $(document).on('click', '.row-delete-button', function(event) {
            var delete_url = $(this).attr('delete-url');
            event.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: "Are You Sure You Want To Delete This",
                showCancelButton: true,
                confirmButtonColor: '#ff0a36',
                confirmButtonText: `Yes, delete it!`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: delete_url,
                        type: "delete",
                        cache: false,
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            if (data.status == true) {
                                toastr.success('Success', data.message, {
                                    timeOut: 5000
                                });
                                window.location.reload();
                            } else {
                                toastr.error('Error', data.messageS, {
                                    timeOut: 5000
                                });
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            toastr.error('Error', errorThrown, {
                                timeOut: 5000
                            });
                        }
                    });
                }
            });
        });
    </script>
    @yield('scripts')
</body>
</html>
