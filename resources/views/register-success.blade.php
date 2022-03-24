@extends('layout.template')

@section('title')
    | Register Confirm
@endsection

<body id="login">
    <div class="box login-box">
        <div class="login-box-head">
            <h1>Register</h1>
        </div>
        <div class="login-box-body">
            <table class="table table-no-border">
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td>Yutaka Tokunaga</td>
                    </tr>
                    <tr>
                        <th>E-mail</th>
                        <td>tokunaga818@gmail.com</td>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <td>12345678</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="login-box-footer">
            <div class="text-right">
                <a href="{{ url('register/success/2') }}" class="btn btn-primary">Submit</a>
            </div>
        </div>
    </div>
</body>
