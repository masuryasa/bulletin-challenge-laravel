<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Timedoor Admin | @yield('title','Dashboard')</title>

    {{-- BS Style --}}
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugin/bootstrap/bootstrap.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugin/font-awesome/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/Ionicons/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin.css') }}">
    <!-- TMDR Preset -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/tmdrPreset.css') }}">
    <!-- Custom css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/custom.css') }}">
    <!-- Skin -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/skin.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet"
        href="{{ asset('assets/admin/plugin/bootstrap-datepicker/bootstrap-datetimepicker.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugin/daterangepicker/daterangepicker.css') }}">
    <!-- DataTable -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugin/datatable/datatables.min.css') }}">
    <!-- DataTable -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugin/selectpicker/bootstrap-select.css') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    {{-- Custom CSS --}}
    <style>
        .pre-body {
            white-space: pre-wrap;
        }

    </style>

    {{-- JS Script --}}
    <!-- jQuery 3 -->
    <script src="{{ asset('assets/admin/plugin/jquery/jquery.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets/admin/plugin/jquery/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('assets/admin/plugin/bootstrap/bootstrap.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('assets/admin/plugin/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugin/daterangepicker/daterangepicker.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ asset('assets/admin/plugin/bootstrap-datepicker/bootstrap-datetimepicker.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/admin/js/adminlte.min.js') }}"></script>
    <!-- DataTable -->
    <script src="{{ asset('assets/admin/plugin/datatable/datatables.min.js') }}"></script>
    <!-- CKEditor -->
    <script src="{{ asset('assets/admin/plugin/ckeditor/ckeditor.js') }}"></script>
    <!-- Selectpicker -->
    <script src="{{ asset('assets/admin/plugin/selectpicker/bootstrap-select.js') }}"></script>
    {{-- Script --}}
    <script src="{{ asset('assets/admin/js/script.js') }}"></script>
    <script>
        // BOOTSTRAP TOOLTIPS
        if ($(window).width() > 767) {
            $(function() {
                $('[rel="tooltip"]').tooltip()
            });
        };
    </script>
</head>

@yield('body');

</html>
