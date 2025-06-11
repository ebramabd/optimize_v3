@extends('admin_panel.layout.master')
@section('title')
    {{ __('admin.details') }} {{ __('admin.terms') }}
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
                            <label class="fs-6 fw-semibold mb-2">{{ __('admin.details') }} {{ __('admin.terms') }}</label>
<textarea class="textarea" disabled
name="condition_text" rows="4" cols="50"
placeholder="Enter your condition here...">
{{field_value($object , 'condition_text')}}
</textarea>
                        </div>


                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('admin.details') }} {{ __('admin.terms_ar') }}</label>
<textarea class="textarea" disabled dir="rtl"
name="condition_text" rows="4" cols="50"
placeholder="Enter your condition here...">
{{field_value($object , 'condition_text_ar')}}
</textarea>
                        </div>

                        @if($object->branch_id != null)
                            @php
                                $branch = \App\Models\Company::where('id' ,$object->branch_id)->first();
                            @endphp
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Branch Name</label>
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


