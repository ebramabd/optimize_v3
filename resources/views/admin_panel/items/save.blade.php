@extends('admin_panel.layout.master')
@section('title')
    {{ __('admin.products') }}
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
                      action="{{ route('admin-panel.items.save_post' , object_id($object) )}}"
                      enctype="multipart/form-data"
                      method="post">
                    @csrf
                    <!--begin::Modal body-->
                    <div class="modal-body px-lg-17">
                        <input type="hidden" value="{{object_id($object)}}" name="id">

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.product_name') }}</label>
                            <input type="text" class="form-control" name="item_name"
                                   value="{{field_value($object , 'item_name')}}"/>
                        </div>
                        @php
                            $brandSelected = null;

                            if (isset($object) && $object->brand_id) {
                                $brandSelected = \App\Models\Brand::where('id', $object->brand_id)->first();
                            }
                        @endphp
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.brand_name') }}</label>
                            <select class="form-control" name="brand_id">
                                @isset($brands)
                                <option selected value="{{ $brandSelected == null ? '': $brandSelected->id }}">{{ $brandSelected == null ? '': $brandSelected->brand_name}}</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                @endisset
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

