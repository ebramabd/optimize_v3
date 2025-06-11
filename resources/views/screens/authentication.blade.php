@extends('layout.general')

@section('content')
<div class="container-fluid p-0 m-0">
    <div class="row g-0">
        <!-- Left side with car illustration -->
        <div class="col-6 illustration-side">
            <div class="illustration-container">
                <img class="login-car" src="{{asset('assets/imgs/login-car.svg')}}">
            </div>
        </div>

        <!-- Right side with login form -->
        <div class="col-6 login-side">
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
                            <a href="{{route('recover.password')}}" class="forgot-password">Forgot Password ?</a>
                        </div>
                        <button type="submit" class="main-btn col-12 login-btn">Login</button>
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
                            <input type="" class="form-control" id="" placeholder="Password">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Confirm Password</label>
                            <input type="" class="form-control" id="" placeholder="Confirm Password">
                        </div>

                        <div class="mb-4 text-center">
                            <p>Upload Commercial Registration</p>
                            <img class="upload-icon" src="{{asset('assets/icons/attach-file-icon.svg')}}">
                        </div>

                        <div class="mb-4 text-center">
                            <p>Upload Tax File</p>
                            <img class="upload-icon" src="{{asset('assets/icons/attach-file-icon.svg')}}">
                        </div>

                        <div class="form-check register-checkbox">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault"> By Registering This Data , You Agree To The Terms And Conditions</label>
                        </div>

                        <button type="submit" class="main-btn col-12 register-btn">Sign Up</button>
                    </form>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function ()
        {
           $('.login-btn').on('click' , function()
           {
               alert('Logged In Successfully')
           })

            $('.register-btn').on('click' , function()
           {
               alert('Registered Successfully')
           })

        });
    </script>
@endsection
