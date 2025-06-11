@extends('admin_panel.layout.master')
@section('title')
    {{ __('common.subscriptions') }}
@endsection

@push('header')
@endpush

@section('content')
    <style>
        .input-group {
            max-width: 500px; /* Adjust width */
        }

        .input-group .form-control {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        .input-group .btn {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .btn-outline-danger {
            border-color: #dc3545;
            color: #dc3545;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-success {
            margin-top: 10px;
            border-radius: 8px;
        }

    </style>
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
                      action="{{ route('admin-panel.subscriptions.save_post' , object_id($object) )}}"
                      enctype="multipart/form-data"
                      method="post">
                    @csrf
                    <!--begin::Modal body-->
                    <div class="modal-body px-lg-17">
                        <input type="hidden" value="{{object_id($object)}}" name="id">

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('admin.title') }}</label>
                            <input type="text" class="form-control" name="title"
                                   value="{{field_value($object , 'title')}}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('admin.title_ar') }}</label>
                            <input type="text" class="form-control" name="title_ar"
                                   value="{{field_value($object , 'title_ar')}}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('admin.period') }}</label>
                            <input type="number" class="form-control" name="period"
                                   value="{{field_value($object , 'period')}}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('admin.price') }}</label>
                            <input type="text" class="form-control" name="price"
                                   value="{{field_value($object , 'price')}}"/>
                        </div>

                        <div class="row">
                            {{-- English Description --}}
                            <div class="col-md-6">
                                <label class="fs-6 fw-semibold mb-2">{{ __('admin.desc') }}</label>
                                @php
                                    $descriptions_en = json_decode(field_value($object, 'description'), true) ?? [];
                                @endphp

                                @if(!empty($descriptions_en))
                                    @foreach($descriptions_en as $desc)
                                        <div class="input-group fv-row mb-3">
                                            <input type="text" class="form-control" name="description[]" value="{{ $desc }}" placeholder="Enter description">
                                            <button class="btn btn-outline-danger remove" type="button">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="input-group fv-row mb-3">
                                        <input type="text" class="form-control" name="description[]" value="" placeholder="Enter description">
                                        <button class="btn btn-outline-danger remove" type="button">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endif

                                <button type="button" class="btn btn-success more">
                                    <i class="fas fa-plus"></i> {{ __('admin.add_more') }}
                                </button>
                            </div>

                            {{-- Arabic Description --}}
                            <div class="col-md-6">
                                <label class="fs-6 fw-semibold mb-2">{{ __('admin.desc_ar') }}</label>

                                @php
                                    $descriptions = json_decode(field_value($object, 'description_ar'), true) ?? [];
                                @endphp

                                @if(!empty($descriptions))
                                    @foreach($descriptions as $desc)
                                        <div class="input-group fv-row mb-3">
                                            <input type="text" class="form-control" name="description_ar[]" value="{{ $desc }}" placeholder="Enter description">
                                            <button class="btn btn-outline-danger remove" type="button">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="input-group fv-row mb-3">
                                        <input type="text" class="form-control" name="description_ar[]" value="" placeholder="Enter description">
                                        <button class="btn btn-outline-danger remove" type="button">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endif

                                <button type="button" class="btn btn-success more_ar">
                                    <i class="fas fa-plus"></i> {{ __('admin.add_more') }}
                                </button>
                            </div>
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
@push('footer')
    <script>
        $(document).ready(function() {
            $(".more").click(function(e) {
                e.preventDefault(); // Prevent form submission

                var newInput = `
                <div class="input-group fv-row mb-3">
                                    <input type="text" class="form-control" name="description[]" placeholder="Enter description">
                                    <button class="btn btn-outline-danger remove" type="button">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
            `;
                $(this).before(newInput);
            });

            $(".more_ar").click(function(e) {
                e.preventDefault(); // Prevent form submission

                var newInput = `
                <div class="input-group fv-row mb-3">
                                    <input type="text" class="form-control" name="description_ar[]" placeholder="Enter description">
                                    <button class="btn btn-outline-danger remove" type="button">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
            `;
                $(this).before(newInput);
            });

            $(document).on("click", ".remove", function(e) {
                e.preventDefault();
                $(this).parent().remove();
            });
        });
    </script>
@endpush
