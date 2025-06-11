@extends('admin_panel.layout.master')
@section('title')
    {{ __('admin.details') }} {{ __('admin.user') }}
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
                <form class="form" action="" method="post">
                    @csrf
                    <!--begin::Modal body-->
                    <div class="modal-body px-lg-17">
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.first_name') }}</label>
                            <input type="text"
                                   style=" color: black; font-weight: bold; "
                                   class="form-control highlight-input"
                                   name="carType" value="{{ $object->name }}" disabled
                            />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.last_name') }}</label>
                            <input type="text"
                                   style=" color: black; font-weight: bold; "
                                   class="form-control highlight-input"
                                   name="carType" value="{{ $object->last_name}}" disabled
                            />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.phone') }}</label>
                            <input type="text"
                                   style=" color: black; font-weight: bold; "
                                   class="form-control highlight-input"
                                   name="carType" value="{{ $object->phone}}" disabled
                            />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.email') }}</label>
                            <input type="text"
                                   style=" color: black; font-weight: bold; "
                                   class="form-control highlight-input"
                                   name="carType" value="{{ $object->email }}" disabled
                            />
                        </div>


                        @php
                        $user_type = \App\Enums\UserType::getSpecificStatus($object->type)
                         @endphp
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('admin.user_type') }}</label>
                            <input type="text"
                                   style=" color: black; font-weight: bold; "
                                   class="form-control highlight-input"
                                   name="carType" value="{{ $user_type }}" disabled
                            />
                        </div>

                        @if($object->type == \App\Enums\UserType::Branch_Administrator)
                            @php
                                $branch = \App\Models\Company::where('id' ,$object->branch_id)->first();
                            @endphp
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Branch</label>
                                <input type="text"
                                       style=" color: black; font-weight: bold; "
                                       class="form-control highlight-input"
                                       name="carType" value="{{ $branch->company_name }}" disabled
                                />
                            </div>

                        @endif

                    </div>
                </form>
                <!--end::Modal body-->
            </div>
        </div>
    </div>
    <!--end::Content container-->
@endsection


