@extends('layout.template')

@section('title', '| Forgot Password')

<body>
    <div class="box login-box">
        <div class="login-box-head">
            <h1 class="mb-5">Reset Password</h1>
            <p class="text-lgray">Please enter your valid email</p>
        </div>
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="login-box-body">
                <div class="form-group">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" placeholder="E-mail" required>
                    @error('email')
                        <div class="invalid-input">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="login-box-footer">
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Email Password Reset Link</button>
                </div>
            </div>
        </form>
    </div>
</body>
