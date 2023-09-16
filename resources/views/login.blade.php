<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Icon -->
    <link rel="stylesheet"
        href="{{ asset('client/register/fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('client/register/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('client/bootstrap/bootstrap.min.css') }}">
</head>

<body>

    <div class="main">

        <section class="signup">
            <div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="signup-content" style="margin-top: 20px">
                            <form action="{{ route('login.store') }}" method="POST" id="signup-form"
                                class="signup-form">
                                @csrf
                                <h3 class="form-title text-center mb-5">Đăng nhập vào ADMIN</h3>
                                @if (session('msg-success'))
                                    <div class="alert alert-success text-center">
                                        {{ session('msg-success') }}
                                    </div>
                                @endif
                                @if (session('msg-error'))
                                    <div class="alert alert-danger text-center">
                                        {{ session('msg-error') }}
                                    </div>
                                @endif
                                <div class="form-group">
                                    <input type="text" class="form-input" name="email" id="email"
                                        placeholder="Email" value="{{ old('email') }}" />
                                    <p style="color: red">{{ $errors->first('email') }}</p>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-input" name="password" id="password"
                                        placeholder="Mật khẩu" />
                                    <span toggle="password" class="zmdi zmdi-eye field-icon toggle-password"
                                        onclick="myFunction()"></span>
                                    <p style="color: red">{{ $errors->first('password') }}</p>
                                </div>
                                <div class="form-group">
                                    <input style="cursor: pointer" type="submit" class="form-submit"
                                        value="Đăng Nhập" />
                                </div>
                            </form>
                            <p class="loginhere">
                                <a href="/forgot-password" class="loginhere-link">Quên mật khẩu ?</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </section>

    </div>
    <!-- JS -->
    <script src="{{ asset('client/register/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('client/register/js/main.js') }}"></script>
    <script src="{{ asset('client/register/js/eye.js') }}"></script>
</body>

</html>
