@extends('admin_panel.layout.master')
@section('title')
    {{ __('admin.details') }} {{ __('admin.subscription') }}
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
                            <label class="fs-6 fw-semibold mb-2">{{ __('admin.title') }}</label>
                            <input type="text"
                                   style=" color: black; font-weight: bold; "
                                   class="form-control highlight-input"
                                   value="{{ $object->title }}" disabled
                            />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('admin.title_ar') }}</label>
                            <input type="text"
                                   style=" color: black; font-weight: bold; "
                                   class="form-control highlight-input"
                                   value="{{ $object->title_ar }}" disabled
                            />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('admin.period') }}</label>
                            <input type="text"
                                   style=" color: black; font-weight: bold; "
                                   class="form-control highlight-input"
                                   value="{{ $object->period }}" disabled
                            />
                        </div>


                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('admin.price') }}</label>
                            <input type="text"
                                   style=" color: black; font-weight: bold; "
                                   class="form-control highlight-input"
                                   value="${{ $object->price }}" disabled
                            />
                        </div>


                        <div class="row">
                            {{-- English Description --}}
                            <div class="col-md-6">
                                <label class="fs-6 fw-semibold mb-2">{{ __('admin.desc') }}</label>
                                @foreach(json_decode($object->description, true) as $desc)
                                    <div class="input-group fv-row mb-3">
                                        <input type="text" class="form-control" value="{{ $desc }}" disabled>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Arabic Description --}}
                            <div class="col-md-6">
                                <label class="fs-6 fw-semibold mb-2">{{ __('admin.desc_ar') }}</label>
                                @foreach(json_decode($object->description_ar, true) as $desc)
                                    <div class="input-group fv-row mb-3">
                                        <input type="text" class="form-control" value="{{ $desc }}" disabled>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </form>

                <!--end::Modal body-->
            </div>
        </div>
    </div>
    <!--end::Content container-->
@endsection


