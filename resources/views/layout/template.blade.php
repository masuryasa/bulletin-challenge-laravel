<html>

<head>
    <title>Timedoor Challenge - Level 8 @yield('title')</title>

    {{-- styles --}}
    {{-- @stack('bootstrap') --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/tmdrPreset.css') }}">

    {{-- scripts --}}
    <script type="text/javascript" src="{{ asset('assets/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

</head>

@yield('body')

</html>
