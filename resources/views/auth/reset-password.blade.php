@extends('layout.template')

@section('title', '| Reset Password')

<body>
    <div class="box login-box">
        <div class="login-box-head">
            <h1 class="mb-5">Reset Password</h1>
            <p class="text-lgray">Please set your new password</p>
        </div>
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
                <div class="form-group">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Password" required>
                    @error('email')
                        <div class="invalid-input">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        placeholder="Confirmation Password" required>
                    @error('email')
                        <div class="invalid-input">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="login-box-footer">
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </div>
            </div>
        </form>
    </div>
</body>
