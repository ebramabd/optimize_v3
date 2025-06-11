@extends('admin_panel.layout.master')
@section('title')
    {{ __('common.terms_agreement') }}
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
                      action="{{ route('admin-panel.terms.save_post' , object_id($object) )}}"
                      enctype="multipart/form-data"
                      method="post">
                    @csrf
                    <!--begin::Modal body-->
                    <div class="modal-body px-lg-17">
                        <input type="hidden" value="{{object_id($object)}}" name="id">

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('admin.text') }} {{ __('admin.terms') }}</label>
                            <textarea class="textarea"
                                      name="condition_text" rows="4" cols="50"
                                      placeholder="{{ __('admin.enter_term') }}...">{{field_value($object , 'condition_text')}}</textarea>

                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('admin.text') }} {{ __('admin.terms_ar') }}</label>
                            <textarea class="textarea" dir="rtl"
                                      name="condition_text_ar" rows="4" cols="50"
                                      placeholder="اكتب هنا...">{{field_value($object , 'condition_text_ar')}}</textarea>

                        </div>

                        <div class="radio-container">
                            <h2 class="h2-terms">{{ __('common.choose') }} {{ __('admin.branch') }}</h2>
                            <div class="radio-group">
                                <input type="radio" name="branch" value="allBranch" id="allBranch">
                                <label class="label-design" for="allBranch">{{ __('admin.all_branch') }}</label>

                                <input type="radio" name="branch" value="oneBranch" id="oneBranch">
                                <label class="label-design" for="oneBranch">{{ __('admin.one_branch') }}</label>
                            </div>
                        </div>

                        <div class="fv-row mb-7" style="display: none" id="branches">
                            <label class="fs-6 fw-semibold mb-2">{{ __('admin.all_branch') }}</label>
                            <select class="form-control" name="branch_id">
                                <option value="">{{ __('admin.select_branch') }}</option>
                                @isset($branches)
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}" >{{ $branch->company_name }}</option>
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

@push('footer')

    <script>
        $(document).ready(function () {
            $("input[name='branch']").change(function () {
                if ($("#oneBranch").is(":checked")) {
                    $("#branches").slideDown();
                } else {
                    $("#branches").slideUp();
                }
            });
        });
    </script>
@endpush
