@extends('admin_panel.layout.master')
@section('title')
    {{ __('admin.companies') }}
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
                      action="{{ route('admin-panel.companies.save_post' , object_id($object) )}}"
                      enctype="multipart/form-data"
                      method="post">
                    @csrf
                    <!--begin::Modal body-->
                    <div class="modal-body px-lg-17">
                        <input type="hidden" value="{{object_id($object)}}" name="id">

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.company_name') }}</label>
                            <input type="text" class="form-control" name="company_name"
                                   value="{{field_value($object , 'company_name')}}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.trade_name') }}</label>
                            <input type="text" class="form-control" name="trade_name"
                                   value="{{field_value($object , 'trade_name')}}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.commercial_no') }}</label>
                            <input type="number" class="form-control" name="commercial_registration_number"
                                   value="{{field_value($object , 'commercial_registration_number')}}"/>
                        </div>


                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.tax_no') }}</label>
                            <input type="number" class="form-control" name="tax_number"
                                   value="{{field_value($object , 'tax_number')}}"/>
                        </div>


                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.owner_name') }}</label>
                            <input type="text" class="form-control" name="owner_name"
                                   value="{{field_value($object , 'owner_name')}}"/>
                        </div>


                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.phone') }}</label>
                            <input type="text" class="form-control" name="phone_number"
                                   value="{{field_value($object , 'phone_number')}}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.email') }}</label>
                            <input type="text" class="form-control" name="email"
                                   value="{{field_value($object , 'email')}}"/>
                        </div>

                        @if(!$object)
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">{{ __('admin.pass') }}</label>
                                <input type="text" class="form-control" name="password"
                                       value="{{field_value($object , 'password') }}"/>
                            </div>

                            <div class="fv-row mb-7">
                                <label for="password-confirm" class="fs-6 fw-semibold mb-2">{{ __('common.confirm_pass') }}</label>
                                <input id="password-confirm" type="text" class="form-control"
                                       name="password_confirmation" required autocomplete="new-password">
                            </div>
                        @endif


                        @php
                            $types = \App\Enums\CompanyStatus::get_type_user();
                            $selected_type = \App\Enums\CompanyStatus::getSpecificStatus(field_value($object , 'type'))
                         @endphp
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('admin.status') }} {{ __('admin.company') }}</label>
                            <select class="form-control" name="status">
                                <option selected value="{{ field_value($object, 'status') }}">{{ $selected_type }}</option>
                                @foreach($types as $key => $type)
                                    <option value="{{ $key }}" {{ field_value($object, 'status') == $key ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>

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

