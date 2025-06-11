@extends('admin_panel.layout.master')
@section('title')
    {{ __('admin.users') }}
@endsection

@push('header')
@endpush

@section('content')
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl mb-4">
    </div>
    <!--end::Content container-->
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="row">
            <!-- left card -->
            <div class="card card-flush py-10">
                <form class="form"
                      action="{{ route('admin-panel.users.save_post' , object_id($object) )}}"
                      enctype="multipart/form-data"
                      method="post">
                    @csrf
                    <!--begin::Modal body-->
                    <div class="modal-body px-lg-17">
                        <input type="hidden" value="{{object_id($object)}}" name="id">

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.first_name') }}</label>
                            <input type="text" class="form-control" name="name"
                                   value="{{field_value($object , 'name')}}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.last_name') }}</label>
                            <input type="text" class="form-control" name="last_name"
                                   value="{{field_value($object , 'last_name')}}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.phone') }}</label>
                            <input type="text" class="form-control" name="phone"
                                   value="{{field_value($object , 'phone')}}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.email') }}</label>
                            <input type="text" class="form-control" name="email"
                                   value="{{field_value($object , 'email')}}"/>
                        </div>

                        @php
                            $types = \App\Enums\UserType::get_type_user();
                            $selected_type = \App\Enums\UserType::getSpecificStatus(field_value($object , 'type'))
                        @endphp

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('admin.user_type') }}</label>
                            <select class="form-control" name="type" id="userType">
                                {{--                                <option selected value="{{ field_value($object, 'type') }}">{{ $selected_type }}</option>--}}
                                <option selected>{{ __('admin.select_type') }}</option>
                                @foreach($types as $key => $type)
                                    <option value="{{ $key }}" >{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="fv-row mb-7" style="display: none" id="branches">
                            <label class="fs-6 fw-semibold mb-2">All branches</label>
                            <select class="form-control" name="branch_id">
                                <option value="">select branch</option>
                                @isset($branches)
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}" >{{ $branch->company_name }}</option>
                                    @endforeach
                                @endisset

                            </select>
                        </div>

                        @if(!$object)
                            <div class="fv-row mb-7" id="passwordField" style="display: none">
                                <label class="fs-6 fw-semibold mb-2">Password</label>
                                <input type="text" class="form-control" name="password"
                                       value="{{field_value($object , 'password') }}"/>
                            </div>

                            <div class="fv-row mb-7" id="passwordConfirmField" style="display: none">
                                <label for="password-confirm" class="fs-6 fw-semibold mb-2">Confirm Password</label>
                                <input id="password-confirm" type="text" class="form-control"
                                       name="password_confirmation"  autocomplete="new-password">
                            </div>
                        @endif




                    </div>
                    <div class="modal-footer flex-center pt-8">
                        <!--begin::Button-->
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">{{ __('common.submit') }}</span>
                        </button>
                        <!--end::Button-->
                    </div>
                </form>
                <!--end::Modal body-->
            </div>
        </div>
    </div>
    <!--end::Content container-->
@endsection

@push('footer')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var userType = document.getElementById("userType");
            var passwordField = document.getElementById("passwordField");
            var passwordConfirmField = document.getElementById("passwordConfirmField");
            var branches = document.getElementById("branches");

            function togglePasswordField() {
                var userTypeValue = parseInt(userType.value); // Ensure value is treated as a number

                // Show password & confirm password fields for Admin and Branch_Administrator
                if (userTypeValue === {{\App\Enums\UserType::Admin}} || userTypeValue === {{\App\Enums\UserType::Branch_Administrator}}) {
                    passwordField.style.display = "block";
                    passwordConfirmField.style.display = "block";
                } else {
                    passwordField.style.display = "none";
                    passwordConfirmField.style.display = "none";
                }

                // Show branches field only for Branch_Administrator
                if (userTypeValue === {{\App\Enums\UserType::Branch_Administrator}}) {
                    branches.style.display = "block";
                } else {
                    branches.style.display = "none";
                }
            }

            // Run on page load in case "admin" is preselected
            togglePasswordField();

            // Listen for changes in the dropdown
            userType.addEventListener("change", togglePasswordField);
        });
    </script>
@endpush
