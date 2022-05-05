@extends('layout.template')

@section('title', '| Login')

<body id="login">
    <div class="box login-box">
        <div class="login-box-head">
            <h1 class="mb-5">Login</h1>
            <p class="text-lgray">Please login to continue...</p>
        </div>
        <form action="{{ route('admins.login.action') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="login-box-body">
                <div class="form-group">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" placeholder="E-mail" required>
                    {{-- <p class="mt-5 small text-danger">*this field can't be empty</p> --}}
                    @error('email')
                        <div class="invalid-input">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Password" required>
                    {{-- <p class="mt-5 small text-danger hide">*this field can't be empty</p> --}}
                    @error('password')
                        <div class="invalid-input">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="login-box-footer">
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</body>
