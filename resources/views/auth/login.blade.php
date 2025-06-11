{{--

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{url('design/admin')}}/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet"
          type="text/css"/>
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{url('design/admin')}}/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('design/admin')}}/assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('design/admin')}}/assets/css/custom.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('design/admin')}}/assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css"/>
    <!--end::Global Stylesheets Bundle-->

    <style>
        body, html {
            height: 100%;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .login-container {
            display: flex;
            height: 100vh;
        }

        .left-side {
            background: url("{{asset('assets/imgs/login-car.svg')}}") no-repeat center center;
            background-size: cover;
            /*background-position: center;*/
            position: relative;
        }

        .company-logo {
            width: 100%;
            max-width: 100%;
            padding: 10px;
        }

        .bottom-text {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            padding: 20px;
            color: #000;
            background: rgba(255, 255, 255, 0.7);
        }

        .login-box {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            color: white;
        }

        .welcome-text {
            font-size: 42px;
            font-weight: 500;
            margin-bottom: 60px;
            text-align: center;
        }

        .right-side {
            background-color: #014294;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-btn {
            margin-top: 40px;
            padding: 12px !important;
            font-size: 20px;
            font-weight: bold;
        }

        #togglePasswordLogin {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
        }

        #togglePasswordLogin i {
            padding-top: 30px;
            font-size: 18px;
            color: #666;
        }

    </style>
</head>

<body>

<div class="container-fluid p-0">
    <div class="row full-height m-0">
        <div class="col-lg-6 left-side p-0">
            --}}
{{--            <img src="{{url('assets/imgs/bg2.jpg')}}" class="company-logo" alt="Company Logo">--}}{{--

        </div>
        <!-- Right Side with Login Form -->
        <div class="col-lg-6 right-side p-0">
            <div class="login-box">
                <div class="welcome-text">Welcome Back!</div>
                <form action="{{route('login')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label" style="color: white;">Email</label>
                        <input type="text" class="form-control" id="email" name="email" style="padding: 14px;" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 position-relative ">
                        <label for="password" class="form-label" style="color: white;">Password</label>
                        <input
                            type="password"
                            class="form-control"
                            id="passwordLogin"
                            name="password" style="padding: 14px;"
                            @error('password') is-invalid @enderror
                            name="password" required
                            autocomplete="current-password"  />

                        <button type="button" class="btn btn-outline-secondary" id="togglePasswordLogin">
                            <i class="fa fa-eye" id="passwordIcon"></i>
                        </button>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="my-6 form-check d-flex justify-content-between">
                        <div>
                            <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" style="color: white;" for="remember">Remember me</label>
                        </div>

                        <div>
                            @if (Route::has('password.request'))
                                <a href="">Forgot Password?</a>
                            @endif
                        </div>
                    </div>
                    <div class="">
                        <input type="submit" class="form-control login-btn" value="Login" style="padding: 14px;">
                        <a class="btn btn-link text-white" href="{{ route('register') }}">
                            create new accent
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{url('design/admin')}}/assets/plugins/global/plugins.bundle.js"></script>
<script src="{{url('design/admin')}}/assets/js/scripts.bundle.js"></script>
<script src="{{url('design/assets/js/helper.js')}}"></script>
<script src="{{url('design/admin')}}/assets/js/custom.js"></script>
<script src="{{url('design/admin')}}/assets/js/moment.min.js"></script>
<script src="{{url('design/admin')}}/assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    document.getElementById('togglePasswordLogin').addEventListener('click', function () {
        var passwordField = document.getElementById('passwordLogin');
        var passwordIcon = document.getElementById('passwordIcon');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            passwordIcon.classList.remove('fa-eye');
            passwordIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            passwordIcon.classList.remove('fa-eye-slash');
            passwordIcon.classList.add('fa-eye');
        }
    });
</script>
<!--end::Global Javascript Bundle-->
</body>
</html>
--}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Vendor & Global Styles -->
    <link href="{{url('design/admin')}}/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('design/admin')}}/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('design/admin')}}/assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('design/admin')}}/assets/css/custom.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('design/admin')}}/assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css"/>

    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            background: url("{{asset('assets/imgs/login-car2.svg')}}") no-repeat center center fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            height: 100vh;
        }


        .login-box {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background-color:rgba(249, 250, 251, 0.3); /* Blue background with transparency */
            border-radius: 12px;
            color: white;

            /* Make it stick to the right side with a gap */
            margin-right: 100px;
            margin-left: auto;
            margin-top: 100px;

        }
        .form-label {
            font-size: 16px; /* الحجم الذي تريده */
            color: #ffffff;  /* اللون الذي تريده، مثلاً أبيض */
            font-weight: 500; /* وزن الخط (اختياري) */
        }


        .welcome-text {
            font-size: 38px;
            font-weight: 600;
            margin-bottom: 40px;
            text-align: center;
        }

        .login-btn {
            margin-top: 30px;
            padding: 14px !important;
            font-size: 22px;
            font-weight: bold;
        }

        #togglePasswordLogin {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
        }

        #togglePasswordLogin i {
            font-size: 18px;
            margin-top: 39PX;
            color: #ccc;
        }

        a {
            color: #fff;
            text-decoration: underline;
        }

        .form-check-label {
            color: white;
        }

        .form-control {
            padding: 14px;
            background-color: rgba(255, 255, 255, 0.1); /* أبيض شفاف بنسبة 10% */
            color: #fff; /* النص يكون أبيض */
            border: 1px solid rgba(255, 255, 255, 0.3); /* حدود خفيفة */
        }
        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.2); /* شفافية أعلى عند التركيز */
            border-color: rgba(255, 255, 255, 0.5);
            color: #fff;
            box-shadow: none;
        }


    </style>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <div class="logo" style="   margin-right: 100px;
            margin-left: auto;
            margin-top: 100px;">
                <img src="{{asset('assets/imgs/pattern_logo.svg')}}" alt="patternauto">
            </div>
        </div>

        <div class="col-lg-8">
            <div class="login-box">
                <div class="welcome-text">Welcome Back!</div>
                <form action="{{route('login')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                        @enderror
                    </div>

                    <div class="mb-3 position-relative">
                        <label for="password" class="form-label">Password</label>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="passwordLogin"
                               name="password"
                               required autocomplete="current-password">
                        <button type="button" id="togglePasswordLogin">
                            <i class="fa fa-eye" id="passwordIcon"></i>
                        </button>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                        @enderror
                    </div>

                    <div class="form-check d-flex justify-content-between mb-4">
                        <div>
                            <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Forgot Password?</a>
                        @endif
                    </div>

                    <input type="submit" class="form-control login-btn" value="Login">
                    <div class="text-center mt-3">
                        <a class="btn btn-link text-white" href="{{ route('register') }}">
                            Create new account
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>


<!-- Scripts -->
<script src="{{url('design/admin')}}/assets/plugins/global/plugins.bundle.js"></script>
<script src="{{url('design/admin')}}/assets/js/scripts.bundle.js"></script>
<script src="{{url('design/assets/js/helper.js')}}"></script>
<script src="{{url('design/admin')}}/assets/js/custom.js"></script>
<script src="{{url('design/admin')}}/assets/js/moment.min.js"></script>
<script src="{{url('design/admin')}}/assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    document.getElementById('togglePasswordLogin').addEventListener('click', function () {
        var passwordField = document.getElementById('passwordLogin');
        var passwordIcon = document.getElementById('passwordIcon');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            passwordIcon.classList.remove('fa-eye');
            passwordIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            passwordIcon.classList.remove('fa-eye-slash');
            passwordIcon.classList.add('fa-eye');
        }
    });
</script>
</body>
</html>
