@extends('layout.template')

@section('title')
    | Register
@endsection

<body id="login">
    <div class="box login-box">
        <div class="login-box-head">
            <h1 class="mb-5">Register</h1>
            <p class="text-lgray">Please fill the information below...</p>
        </div>
        <div class="login-box-body">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Name">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="E-mail">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password">
            </div>
        </div>
        <div class="login-box-footer">
            <div class="text-right">
                <a href="{{ url('login') }}" class="btn btn-default">Back</a>
                <a href="{{ url('register/success') }}" class="btn btn-primary">Confirm</a>
            </div>
        </div>
    </div>
</body>
