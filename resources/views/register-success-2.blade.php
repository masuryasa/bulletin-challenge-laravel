@extends('layout.template')

@section('title')
    | Register Success
@endsection

<body id="login">
    <div class="box login-box text-center">
        <div class="login-box-head">
            <h1>Successfully Registered</h1>
        </div>
        <div class="login-box-body">
            <p>Thank you for your membership register.<br />
                We send confirmation e-mail to you. Please complete the registration by clicking the confirmation URL.
            </p>
        </div>
        <div class="login-box-footer">
            <div class="text-center">
                <a href="{{ url('') }}" class="btn btn-primary">Back to Home</a>
            </div>
        </div>
    </div>
</body>
