<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

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

        .pre-body {
            white-space: pre-wrap;
        }

        #logout {
            position: relative;
            display: block;
            padding-left: 15px;
            padding-right: 15px;
            padding-top: 15px;
            padding-bottom: 15px;
        }

    </style>

    {{-- JS scripts --}}
    <script type="text/javascript" src="{{ asset('assets/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/script.js') }}"></script>

</head>

@yield('body')

</html>
