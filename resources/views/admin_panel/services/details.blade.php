@extends('admin_panel.layout.master')
@section('title')
    {{ __('admin.details') }} {{ __('admin.service') }}
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
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.service_name') }}</label>
                            <input type="text"
                                   style="color: black; font-weight: bold;"
                                   class="form-control highlight-input"
                                   value="{{ $service->service_name }}" disabled
                            />
                        </div>

                        @isset($object)
                            @foreach($object as $brand)
                                <div class="card mb-5 p-4 shadow-sm rounded">
                                    <div class="fv-row mb-4">
                                        <label class="form-label fs-6 fw-semibold">{{ __('common.brand_name') }}</label>
                                        <input type="text"
                                               class="form-control"
                                               style="color: black; font-weight: bold;"
                                               value="{{ optional(\App\Models\Brand::find($brand->brand_id))->brand_name }}"
                                               disabled>
                                    </div>

                                    @if($brand->item_id)
                                        <div class="fv-row mb-2">
                                            <label class="form-label fs-6 fw-semibold">{{ __('common.product_name') }}</label>
                                            <div class="row">
                                                @foreach(json_decode($brand->item_id) as $item)
                                                    @php
                                                        $itemName = optional(\App\Models\Item::find($item))->item_name;
                                                    @endphp
                                                    <div class="col-md-6 mb-3">
                                                        <input type="text"
                                                               class="form-control"
                                                               style="color: black; font-weight: bold;"
                                                               value="{{ $itemName }}"
                                                               disabled>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <p class="text-muted">{{ __('admin.no_available') }}</p>
                                    @endif
                                </div>
                            @endforeach
                        @endisset




                    @if($service->branch_id != null)
                            @php
                                $branch = \App\Models\Company::where('id' ,$service->branch_id)->first();
                            @endphp
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">{{ __('common.branch_name') }}</label>
                                <input type="text"
                                       style=" color: black; font-weight: bold; "
                                       class="form-control highlight-input"
                                       value="{{ $branch->company_name }}" disabled
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


