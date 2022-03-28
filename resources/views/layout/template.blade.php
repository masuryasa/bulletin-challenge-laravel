<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Timedoor Challenge - Level 8 @yield('title')</title>

    {{-- CSS styles --}}
    {{-- @stack('bootstrap') --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/tmdrPreset.css') }}">

    <style>
        .invalid-input {
            color: #dc3545
        }

        .wrap-text {
            overflow-wrap: break-word;
        }

    </style>

    {{-- JS scripts --}}
    <script type="text/javascript" src="{{ asset('assets/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/script.js') }}"></script>

</head>

@yield('body')

</html>
