@extends('admin_panel.layout.master')
@section('title')
    {{ __('admin.details') }} {{ __('admin.product') }}
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
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.product_name') }}</label>
                            <input type="text"
                                   style=" color: black; font-weight: bold; "
                                   class="form-control highlight-input"
                                   value="{{ $object->item_name }}" disabled
                            />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.brand_name') }}</label>
                            <input type="text"
                                   style=" color: black; font-weight: bold; "
                                   class="form-control highlight-input"
                                   value="{{ $object->brand_name }}" disabled
                            />
                        </div>

                    </div>
                </form>

                <!--end::Modal body-->
            </div>
        </div>
    </div>
    <!--end::Content container-->
@endsection


