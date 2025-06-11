@extends('layout.general')


@section('style')
    <style>


        .position-relative {
            position: relative;
        }

        .password-input {
            padding-right: 40px;
            /* Space for the icon */
        }

        .toggle-password {
            position: absolute;
            left: 237px;
            top: 73%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #666;
            font-size: 18px;
        }

        .password-input2 {
            padding-right: 40px;
            /* Space for the icon */
        }

        .toggle-password2 {
            position: absolute;
            top: 73%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #666;
            font-size: 18px;
        }

        /* LTR (English) */
        :dir(ltr) .toggle-password2 {
            left: 237px;
            right: auto;
        }

        /* RTL (Arabic) */
        :dir(rtl) .toggle-password2 {
            right: 237px;
            left: auto;
        }



        /* Hide the default file input */
        .file-input {
            display: none;
        }

        /* Style for the upload image */
        .upload-icon {
            width: 50px;
            /* Adjust size as needed */
            cursor: pointer;
        }
        .lang-switcher {
            position: absolute;
            top: 10px;
            left: 20px; /* Positioned to the left side */
            z-index: 10;
            display: flex;
            gap: 10px;
            padding-bottom: 30px;
        }

        /* Optional: adjust positioning on very small screens */
        @media (max-width: 600px) {
            .lang-switcher {
                top: 10px;
                left: 10px; /* Adjust left for smaller screens */
                gap: 5px;
                flex-direction: column; /* Stack vertically if needed */
            }
        }



        .btn-lang {
            padding: 6px 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            color: #333;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-lang:hover {
            background-color: #e0e0e0;
        }

        .btn-lang-active {
            background-color: #D83030;
            color: white;
        }


    </style>
@endsection
@section('content')

    <x-modals.phone-code-verification-modal />

    <div class="main-section">
    <!-- Left side -->
    <div class="col-6 illustration-side">
            <div class="illustration-container">
                <img class="login-car" src="{{asset('assets/imgs/login-car.svg')}}">
            </div>
        </div>
       

        <div class="logo">
        <img src="https://patternauto.net/assets/imgs/pattern_logo.svg" alt="patternauto">
    </div>
</div>
                <!-- Right side with login form -->
<div class="lang-wrapper">
        <div class="lang-switcher">
            <a href="{{ route('lang.switch', 'en') }}" class="btn-lang {{ app()->getLocale() === 'en' ? 'btn-lang-active' : '' }}">{{ __('common.en') }}</a>
            <a href="{{ route('lang.switch', 'ar') }}" class="btn-lang {{ app()->getLocale() === 'ar' ? 'btn-lang-active' : '' }}">{{ __('common.ar') }}</a>
        </div>
    </div>
                <div class="login-side">
                  
        <div class="login-container">
           

                           <div class="tabs">
                                <button class="tab-btn login-tab active" data-tab="login">{{ __('common.login') }}</button>
                                <button class="tab-btn register-tab" data-tab="register">{{ __('common.sign_up') }}</button>
                            </div>

                            @include('admin_panel.layout.message')

                            <div class="tab-content active" id="login" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
                                <!-- Login Form -->
                                <form id="login-form" class="form" action="{{ route('companies.login.post')}}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="login_email" class="form-label">{{  __('common.email')  }}</label>
                                        <input type="email" name="email" class="form-control" id="login_email" placeholder="Email" required>
                                    </div>
                                    <div class="mb-3  position-relative">
                                        <label for="password-login" class="form-label">{{  __('common.password')  }}</label>
                                        <input type="password" class="form-control password-input" name="password" id="password-login" required>
                                        <button type="button" class="toggle-password" id="togglePasswordLogin3">
                                            <i class="fa fa-eye" id="passwordIcon3"></i>
                                        </button>
                                    </div>
                                    <div class="mb-4">
                                        <a href="{{route('recover.password')}}" class="forgot-password">{{ __('common.Forgot_Password') }}</a>
                                    </div>
                                    <button type="submit" class="main-btn col-12 login-btn">{{ __('common.login') }}</button>
                                </form>
                            </div>

                            <div class="tab-content" id="register" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
                                <!-- Login Form -->
                                <form id="register-form"
                                      class="form"
                                      action="{{ route('companies.register')}}"
                                      enctype="multipart/form-data"
                                      method="post">
                                    @csrf
                                    <input type="hidden" name="unique_key" value="{{$uniquePageKey}}" id="otp-unique-key">
                                    <input type="hidden" name="otp_code" id="otp_code" value="">
                                    <div class="mb-3">
                                        <label for="company_name" class="form-label">{{ __('common.company_name') }}</label>
                                        <input type="text" class="form-control" id="company_name" name="company_name" placeholder="{{ __('common.company_name') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="trade_name" class="form-label">{{ __('common.trade_name') }}</label>
                                        <input type="text" class="form-control" id="trade_name" name="trade_name" placeholder="{{ __('common.trade_name') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="commercial_registration_number" class="form-label">{{ __('common.commercial_registration_number') }}</label>
                                        <input type="text" class="form-control" id="commercial_registration_number" pattern="\d{10}" maxlength="10" name="commercial_registration_number" placeholder="{{ __('common.commercial_registration_number') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="tax_number" class="form-label">{{ __('common.tax_no') }}</label>
                                        <input type="text" class="form-control" id="tax_number" name="tax_number"  pattern="\d{13,16}" maxlength="16" placeholder="{{ __('common.tax_no') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="owner_name" class="form-label">{{ __('common.owner_name') }}</label>
                                        <input type="text" class="form-control" id="owner_name" name="owner_name" placeholder="{{ __('common.owner_name') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">{{ __('common.email') }}</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('common.email') }}" required>
                                    </div>

{{--
                                    <div class="mb-3 position-relative">
                                        <label for="phone_number" class="form-label">{{ __('common.phone') }}</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="{{ __('common.phone') }}" required>

                                    </div>
--}}

                                    <div class="mb-3">
    <label for="phone_number" class="form-label">{{ __('common.phone') }}</label>
    <div class="phone-input-wrapper">
        <input type="text" required
               class="input-service client-info phone-input"
               name="phone_number"
               id="phone_number"
               placeholder="{{ __('common.phone') }}">

        <input type="button"
               class="confirm-btn confirm-phone-code-btn"
               value="{{ __('common.confirm') }}">
    </div>
</div>




                                    <div class="mb-3 position-relative">
                                        <label for="password" class="form-label">{{ __('common.password') }}</label>
                                        <input
                                            type="password"
                                            class="form-control password-input"
                                            id="password" name="password"
                                            placeholder="Password" required>
                                        <button type="button" class=" toggle-password" id="togglePasswordLogin">
                                            <i class="fa fa-eye" id="passwordIcon"></i>
                                        </button>
                                    </div>

                                    <div class="mb-3  position-relative">
                                        <label for="password-confirm" class="form-label">{{ __('common.confirm_pass') }}</label>
                                        <input type="password" class="form-control password-input2" name="password_confirmation" id="password-confirm" placeholder="{{ __('common.confirm_pass') }}" required>
                                        <button type="button" class="toggle-password2" id="togglePasswordLogin2">
                                            <i class="fa fa-eye" id="passwordIcon2"></i>
                                        </button>
                                    </div>

                                    <div class="mb-4 text-center">
                                        <p>{{ __('common.commercial_registration_number') }}</p>
                                        <input type="file" name="file_commercial" class="file-input" id="fileInput" required>
                                        <img class="upload-icon" src="{{ asset('assets/icons/attach-file-icon.svg') }}" id="uploadTrigger">
                                        <span id="fileNameDisplay1" class="d-block mt-2 text-muted-file" style="color: red"></span>
                                    </div>

                                    <div class="mb-4 text-center">
                                        <p>Upload Tax File</p>
                                        <input type="file" name="file_tax" class="file-input" id="fileInput2">
                                        <img class="upload-icon" src="{{asset('assets/icons/attach-file-icon.svg')}}" id="uploadTrigger2">
                                        <span id="fileNameDisplay2" class="d-block mt-2 text-muted-file" style="color: red"></span>
                                    </div>

                                    <div class="form-check register-checkbox">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">{{ __('common.text_terms') }} </label>
                                    </div>
                                    <button type="submit" class="confirm-btn {{--confirm-phone-code-btn--}} main-btn col-12 register-btn">{{ __('common.sign_up') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>

        document.getElementById('togglePasswordLogin').addEventListener('click', function() {
            var passwordField = document.getElementById('password');
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

        document.getElementById("togglePasswordLogin2").addEventListener("click", function() {
            let passwordInput = document.getElementById("password-confirm");
            let icon = document.getElementById("passwordIcon2");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        });

        document.getElementById("togglePasswordLogin3").addEventListener("click", function() {
            let passwordInput = document.getElementById("password-login");
            let icon = document.getElementById("passwordIcon3");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        });


        $(document).ready(function() {
            // $('.login-btn').on('click' , function()
            // {
            //     alert('Logged In Successfully')
            // })

            //  $('.register-btn').on('click' , function()
            // {
            //     alert('Registered Successfully')
            // })
        });
    </script>

    <script>
        $(function() {
            $('#register-form').on('submit', function(e) {
                e.preventDefault();
                let otp_code = $('#otp_code').val();
                if (otp_code.trim() === '') {
                    return;
                }
                else{
                    this.submit();
                }
            });

            $(document).on('otp_verified', function(event, data) {
                $('#register-form input[name=otp_code]').val(data.message);
            });

            let uniquePageKey = "{{$uniquePageKey}}";
            $(document).on('click', '.confirm-phone-code-btn', function() {
                let phoneNumber = $('#phone_number').val();
                if (phoneNumber.trim() === '') {
                    // alert('Phone number is empty');
                    return;
                }
                let otp_code = $('#register-form input[name=otp_code]').val();
                if (otp_code.trim() === '') {
                    $('#phone-code-verification-modal').modal('show');
                    confirmPhoneCode();
                }
            });

            async function confirmPhoneCode() {
                let url = getUrl();
                let phoneNumber = $('#phone_number').val();
                let ajax_url = url + '/send-phone-code-auth-verification?action=send_code&phoneNumber=' + phoneNumber + '&unique_key=' + uniquePageKey;
                let ajax_method = 'GET';
                var res = await makeAjax(ajax_url, ajax_method);
                $('#phone-code-verification-modal .modal-body').html(res.view);
            }

        });
    </script>

    <script>
        $(document).ready(function () {
            $('#fileInput').on('change', function () {
                const fileName = $(this).prop('files')[0]?.name || '';
                $('#fileNameDisplay1').text(fileName);
            });

            $('#fileInput2').on('change', function () {
                const fileName = $(this).prop('files')[0]?.name || '';
                $('#fileNameDisplay2').text(fileName);
            });

            // Optional: trigger file input when clicking the icon
            $('#uploadTrigger').on('click', function () {
                $('#fileInput').click();
            });

            $('#uploadTrigger2').on('click', function () {
                $('#fileInput2').click();
            });
        });
    </script>

@endsection
