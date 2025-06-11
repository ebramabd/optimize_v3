<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Automize - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
</head>
<body>
<div class="container-fluid p-0 m-0">
    <div class="row g-0">
        <!-- Left side with car illustration -->
        <div class="col-md-6 illustration-side">
            <div class="illustration-container">
                <img class="login-car" src="{{asset('assets/imgs/login-car.svg')}}">
            </div>
        </div>

        <!-- Right side with login form -->
        <div class="col-md-6 login-side">
            <div class="login-container">
                <div class="brand-logo mb-5">Automize</div>

                <div class="tabs">
                    <button class="tab-btn login-tab active" data-tab="login">Login</button>
                    <button class="tab-btn register-tab" data-tab="register">Sign Up</button>
                </div>


                <div class="tab-content active" id="login">
                    <!-- Login Form -->
                    <form id="login-form">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <div class="mb-4">
                            <a href="#" class="forgot-password">Forgot Password?</a>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 login-btn">Login</button>
                    </form>
                </div>

                <div class="tab-content" id="register">
                    <!-- Login Form -->
                    <form id="register-form">

                        <div class="mb-3">
                            <label for="" class="form-label">Company Name</label>
                            <input type="" class="form-control" id="" placeholder="Company Name">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Trade Name</label>
                            <input type="" class="form-control" id="" placeholder="Trade Name">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Commercial Registration Number</label>
                            <input type="" class="form-control" id="" placeholder="Trade Name">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Tax Number</label>
                            <input type="" class="form-control" id="" placeholder="Tax Number">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Owner Name</label>
                            <input type="" class="form-control" id="" placeholder="Owner Name">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="" class="form-control" id="" placeholder="Email">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Phone Number</label>
                            <input type="" class="form-control" id="" placeholder="Phone Number">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Password</label>
                            <input type="" class="form-control" id="" placeholder="Password*">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Confirm Password</label>
                            <input type="" class="form-control" id="" placeholder="Confirm Password*">
                        </div>

                        <div class="mb-4 text-center">
                            <p>Upload Commercial Registration</p>
                            <img src="{{asset('assets/icons/attach-file-icon.svg')}}">
                        </div>

                        <div class="mb-4 text-center">
                            <p>Upload Tax File</p>
                            <img src="{{asset('assets/icons/attach-file-icon.svg')}}">
                        </div>
                        <button type="submit" class="btn btn-primary w-100 login-btn">Sign Up</button>
                    </form>
                </div>


            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
</body>
</html>
