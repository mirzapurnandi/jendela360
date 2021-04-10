<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title')</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{ asset('theme/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('theme/bower_components/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('theme/bower_components/Ionicons/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('theme/dist/css/AdminLTE.min.css') }}">
        <link rel="stylesheet" href="{{ asset('theme/dist/css/skins/_all-skins.min.css') }}">
        <link rel="stylesheet" href="{{ asset('theme/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="shortcut icon" href="{{ asset('favicon_m3codes.ico') }}">
        @stack('stylesheets')
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            @include('layouts.header')

            @include('layouts.sidebar')

            <div class="content-wrapper">

                @yield('breadcrumbs')

                @yield('content')
            </div>

            @include('layouts.footer')

        </div>

        <script src="{{ asset('theme/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('theme/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('theme/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('theme/bower_components/fastclick/lib/fastclick.js') }}"></script>
        <script src="{{ asset('theme/dist/js/adminlte.min.js') }}"></script>
        <script src="{{ asset('theme/dist/js/demo.js') }}"></script>
        <script src="{{ asset('theme/bower_components/moment/min/moment.min.js') }}"></script>
        <script src="{{ asset('theme/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset('theme/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
        <script>
        $(document).ready(function () {
            $('.sidebar-menu').tree()
        })
        </script>
        @stack('scripts')
    </body>
</html>
