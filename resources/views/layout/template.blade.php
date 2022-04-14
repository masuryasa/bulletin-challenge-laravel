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

    {{-- Custom CSS --}}
    <style>
        .invalid-input {
            color: #dc3545
        }

        .wrap-text {
            overflow-wrap: break-word;
        }

        pre.body {
            background-color: rgba(0, 0, 0, 0);
            border: 0px;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            padding: 0px;
            font-size: 14px;
        }

    </style>

    {{-- JS scripts --}}
    <script type="text/javascript" src="{{ asset('assets/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/script.js') }}"></script>

</head>

@yield('body')

</html>
