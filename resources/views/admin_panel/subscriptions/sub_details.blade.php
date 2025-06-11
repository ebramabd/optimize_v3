@extends('admin_panel.layout.master')
@section('title')
    {{ __('admin.details') }} {{ __('admin.subscription') }}
@endsection

@push('header')
@endpush

@section('content')
    <style>
        .photo-card {
            width: 500px;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin: 20px;
        }

        .photo-card img {
            width: 100%;
            height: auto;
            display: block;
        }

        .file-card {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            min-width: 250px;
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
                <form class="form" action="{{route('admin-panel.subscriptions.accept_request')}}" method="post">
                    @csrf
                    <!--begin::Modal body-->
                    <input type="hidden" name="object_id" value="{{$object->id}}"/>
                    <div class="modal-body px-lg-17">

                        @isset($object)

                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Company Name</label>
                                <input type="text"
                                       style=" color: black; font-weight: bold; "
                                       class="form-control highlight-input"
                                       value="{{ $object->company_name }}" disabled
                                />
                            </div>


                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Subscription Name</label>
                                <input type="text"
                                       style=" color: black; font-weight: bold; "
                                       class="form-control highlight-input"
                                       value="{{ $object->title }}" disabled
                                />
                            </div>

                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Request Date</label>
                                <input type="text"
                                       style=" color: black; font-weight: bold; "
                                       class="form-control highlight-input"
                                       value="{{ $object->created_at }}" disabled
                                />
                            </div>


                            <div class="file-card">
                                <h2>File</h2>
                                @isset($object->image)
                                    <a href="{{ asset('storage/' . $object->image) }}" target="_blank" class="file-link">
                                        📄 {{ $object->image }}
                                    </a>
                                @endisset
                            </div>
                     @endisset

                    </div>
                    <div class="modal-footer flex-center pt-8">
                        <!--begin::Button-->
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Accept</span>
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


