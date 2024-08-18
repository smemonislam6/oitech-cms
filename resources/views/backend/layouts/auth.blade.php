
<html lang="en">

<head >
    <meta charset="utf-8" />
    <title >@yield('title', 'Login')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset(get_static_option('general_site_favicon')) }}" type="image/x-icon" />

    <!-- Theme Config Js -->
    <script src="{{ asset('assets/backend/js/config.js') }}"></script>

    <!-- App css -->
    <link href="{{ asset('assets/backend/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('assets/backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    @routes
</head>

<body class="authentication-bg position-relative">

    @yield('auth_content')
    <!-- end page -->

    <footer class="footer footer-alt fw-medium">
        <span class="text-dark">
            {!! get_footer_copyright_text() !!}
        </span>
    </footer>
    <!-- Vendor js -->
    <script src="{{ asset('assets/backend/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/common/js/axios.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/backend/js/app.min.js') }}"></script>

    @stack('scripts')
</body>

</html>
