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
        <form method="POST">
            @csrf
            <div class="login-box-body">
                <div class="form-group">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" placeholder="Name" required>
                    @error('name')
                        <div class="invalid-input">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
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
                        value="{{ old('password') }}" placeholder="Password" required>
                    @error('password')
                        <div class="invalid-input">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="login-box-footer">
                <div class="text-right">
                    <a href="{{ route('index') }}" class="btn btn-default">Back</a>
                    <button type="submit" formaction="{{ route('confirm') }}" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </form>
    </div>
</body>
