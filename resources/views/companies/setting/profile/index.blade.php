@extends('admin_panel.layout.master')

@section('title')
    {{ __('common.profile') }}
@endsection

@push('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <style>


        .password-input {
            padding-right: 40px; /* Space for the icon */
        }

        .toggle-password {
            position: absolute;
            left: 855px;
            top: 0;
            background: none;
            border: none;
            cursor: pointer;
            color: #666;
            font-size: 22px;
        }

        .toggle-password-rtl {
            left: 0 !important;
            transform: translate(50px, 27px);
        }

        .toggle-password-ltr {
            right: 0 !important;
            transform: translate(-15px, 27px);
        }

        .password-input2 {
            padding-right: 40px; /* Space for the icon */
        }

        .toggle-password2 {
            position: absolute;
            left: 855px;
            top: 48% !important;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #666;
            font-size: 22px;
        }


        .profile-icon {
            display: inline-block;
            width: 150px; /* Adjust size */
            height: 150px;
            position: relative;
            cursor: pointer;
            border-radius: 50%;
        }

        .profile-icon i {
            font-size: 24px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #333;
        }

        .profile-icon:hover i {
            color: #007bff;
        }

    </style>
    <!-- Main Content -->
    <div class="p-7">
        <h1 class="home-h1 mb-8">{{ __('common.settings') }} / {{ __('common.profile') }}</h1>

        <div class="card p-4 mb-4">
            <div class="home-subscription d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-end">
                    <img src="{{ asset('assets/imgs/user-pen.svg') }}">
                    <h5 class="service-h5">{{ __('common.profile') }}</h5>
                </div>

                <button type="button" class="change-pass btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                    <i class="bi bi-key me-1"></i> {{ __('common.change_pass') }}
                </button>

                <!-- Change Password Modal -->
                <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-custom-width {{ app()->getLocale() === 'ar' ? 'modal-dialog-rtl' : '' }}">
                        <div class="modal-content">
                            <div class="px-10 modal-header">
                                <h5 class="modal-title" id="changePasswordModalLabel">
                                    <i class="bi bi-lock me-2" style="font-size: 18px"></i>
                                    {{ __('common.change_pass') }}
                                </h5>
                                <button type="button" class="btn-close {{ app()->getLocale() === 'ar' ? 'm-0' : '' }}" data-bs-dismiss="modal" aria-label="Close" style="border: 1px solid #1C4853;border-radius: 50%;"></button>
                            </div>
                            <div class="modal-body">
                                <form
                                    action="{{route('companies.setting.update_password' , $company->id)}}"
                                    enctype="multipart/form-data"
                                    method="post">
                                    @csrf
                                    <div class="p-5 position-relative">
                                        <input
                                            type="password" id="password"
                                            class="input-service password-input"
                                            name="password" placeholder="{{ __('common.new_pass') }}"
                                            style="border-radius: 7px;height: 60px;">

                                        <button type="button" class="toggle-password {{ app()->getLocale() === 'ar' ? 'toggle-password-rtl' : 'toggle-password-ltr ' }}" id="togglePasswordLogin">
                                            <i class="fa fa-eye" id="passwordIcon"></i>
                                        </button>
                                    </div>

                                    <div class="p-5 position-relative">
                                        <input
                                            type="password" id="password-confirm"
                                            class="input-service password-input2"`
                                            name="password_confirmation" placeholder="{{ __('common.confirm_pass') }}"
                                            style="border-radius: 7px;height: 60px;">

                                        <button type="button" class="toggle-password {{ app()->getLocale() === 'ar' ? 'toggle-password-rtl' : 'toggle-password-ltr ' }}" id="togglePasswordLogin2">
                                            <i class="fa fa-eye" id="passwordIcon2"></i>
                                        </button>
                                    </div>

                                    <div class="modal-footer flex-center pt-8 pb-10">
                                        <button type="submit" class="btn w-100" style="height: 60px;">
                                            <span class="indicator-label" style="color: #2FB593;">{{ __('common.save') }}</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center my-12">
                <form id="profileForm" enctype="multipart/form-data" data-url="{{ route('companies.setting.update_profile_picture') }}">
                    @csrf
                    <label for="profilePicInput" class="profile-icon">
                        <img id="profilePreview" class="profile-icon"
                             src="{{ asset('storage/' . $company->profile_picture ?? '') }}"
                             style="display: {{ $company->profile_picture ? 'block' : 'none' }};"
                             alt="Profile Picture">
                        <i class="icon-profile fa-regular fa-user" style="display: {{ $company->profile_picture ? 'none' : 'block' }};"></i>
                    </label>
                    <input type="file" id="profilePicInput" name="profile_picture" accept="image/*" style="display: none;">
                </form>
                <p class="fs-2 fw-normal" style="color: #B1B5BF">{{ __('common.company_logo') }}</p>
            </div>

            <form class="px-20"
                  action="{{route('companies.setting.profile_edit' , $company->id)}}"
                  enctype="multipart/form-data"
                  method="post">
                @csrf
                <input type="hidden" name="id" value="{{$company->id}}">
                <div class="p-5">
                    <label class="fs-6 mb-3">{{ __('common.company_name') }}</label>
                    <input type="text" value="{{$company->company_name}}" class="input-service" name="company_name" placeholder="{{ __('common.company_name') }}">
                </div>

                <div class="p-5">
                    <label class="fs-6 mb-3">{{ __('common.trade_name') }}</label>
                    <input type="text" value="{{$company->trade_name}}" class="input-service" name="trade_name" placeholder="{{ __('common.trade_name') }}">
                </div>

                <div class="p-5">
                    <label class="fs-6 mb-3">{{ __('common.commercial_no') }}</label>
                    <input type="text" value="{{$company->commercial_registration_number}}" class="input-service" name="commercial_registration_number" placeholder="{{ __('common.commercial_no') }}">
                </div>

                <div class="p-5">
                    <label class="fs-6 mb-3">{{ __('common.tax_no') }}</label>
                    <input type="text" value="{{$company->tax_number}}" class="input-service" name="tax_number" placeholder="{{ __('common.tax_no') }}">
                </div>

                <div class="p-5">
                    <label class="fs-6 mb-3">{{ __('common.owner_name') }}</label>
                    <input type="text" value="{{$company->owner_name}}" class="input-service" name="owner_name" placeholder="{{ __('common.owner_name') }}">
                </div>

                <div class="p-5">
                    <label class="fs-6 mb-3">{{ __('common.email') }}</label>
                    <input type="text" value="{{$company->email}}" class="input-service" name="email" placeholder="{{ __('common.email') }}">
                </div>

                <div class="p-5">
                    <label class="fs-6 mb-3">{{ __('common.phone') }}</label>
                    <input type="text" value="{{$company->phone_number}}" class="input-service" name="phone_number" placeholder="{{ __('common.phone') }}">
                </div>

                <div class="modal-footer flex-center pt-8 pb-10">
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label" style="color: #2FB593;">{{ __('common.save') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!--end::Content container-->
@endsection
@push('footer')
    <script>
        document.getElementById('togglePasswordLogin').addEventListener('click', function () {
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

        $(document).ready(function () {
            $("#profilePicInput").change(function () {
                let file = this.files[0];

                if (file) {
                    let reader = new FileReader();

                    reader.onload = function (e) {
                        $("#profilePreview").attr("src", e.target.result).show();
                        $(".profile-icon i").hide();
                    };

                    reader.readAsDataURL(file);
                    uploadProfileImage(file);
                }
            });

            function uploadProfileImage(file) {
                let formData = new FormData();
                formData.append("profile_picture", file);

                let url = $("#profileForm").data("url"); // Get the route from data attribute
                let csrfToken = $('meta[name="csrf-token"]').attr("content"); // Get CSRF Token

                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        "X-CSRF-TOKEN": csrfToken, // Now correctly sending CSRF Token
                    },
                    success: function (response) {
                        if (response.success) {
                            alert("Profile picture updated successfully!");
                        } else {
                            alert("Error uploading image.");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log("AJAX Error:", xhr.responseText);
                        alert("An error occurred. Please try again.");
                    }
                });
            }
        });
    </script>
@endpush
