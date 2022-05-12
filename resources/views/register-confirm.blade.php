@extends('layout.template')

@section('title', '| Register Confirm')

<body id="login">
    <div class="box login-box">
        <div class="login-box-head">
            <h1>Register</h1>
        </div>
        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="login-box-body">
                <table class="table table-no-border">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            {{-- <td>Yutaka Tokunaga</td> --}}
                            <td><input type="text" name="name" value="{{ $user['name'] }}" readonly
                                    style="border: none"></td>
                        </tr>
                        <tr>
                            <th>E-mail</th>
                            {{-- <td>tokunaga818@gmail.com</td> --}}
                            <td><input type="text" name="email" value="{{ $user['email'] }}" readonly
                                    style="border: none"></td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            {{-- <td>12345678</td> --}}
                            <td><input type="text" name="password" value="{{ $user['password'] }}" readonly
                                    style="border: none"></td>
                        </tr>
                        <input type="hidden" name="password_confirmation" value="{{ $user['password'] }}">
                    </tbody>
                </table>
            </div>
            <div class="login-box-footer">
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</body>
