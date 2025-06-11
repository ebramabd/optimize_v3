@extends('admin_panel.layout.master')

@section('title')
    {{ __('common.terms_agreement') }}
@endsection

@push('header')
@endpush

@section('content')
    <style>
        .content {
            padding: 20px;
        }
        .content h6{
            font: normal normal normal 23px/54px Graphik Arabic;
            letter-spacing: 0px;
            color: #1C4853;
        }
        .card-terms {
            border: 1px solid #B1B5BF;
            border-radius: 10px;
            padding: 20px;
        }
        .title-terms{
            height: 85px;
            background: #F9FAFB 0% 0% no-repeat padding-box;
            border-radius: 20px;
        }
        .title-terms h4{
            font: normal normal normal 30px/69px Graphik Arabic;
        }
        .card-terms p {
            color:#212330;
        }
        .edit-btn {
            float: right;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            padding: 6px 12px;
            border-radius: 5px;
        }
        .edit-btn:hover {
            background-color: #e9ecef;
        }

    </style>
    <!-- Main Content -->
    <div class="content">
        <h6>{{ __('common.settings') }} / {{ __('common.terms_agreement') }}</h6>

        <div class="card-terms">
            <div class="home-subscription d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-end">
                    <img src="{{ asset('assets/imgs/user-pen.svg') }}">
                    <h5>{{ __('common.terms_agreement') }}</h5>
                </div>
                <a href="{{route('companies.setting.edit_terms' , $terms->id)}}" style="color: black" class="edit-btn"><i class="fas fa-plus"></i> edit</a>
            </div>

            <div style="padding-top: 24px;padding-bottom: 43px;">
                <textarea disabled style="height: 500px" class="form-control" >{{$terms->condition_text }}</textarea>
            </div>
            @if($terms->condition_text_ar)
            <div style="padding-top: 24px;padding-bottom: 43px;">
                <textarea disabled dir="rtl" style="height: 500px" class="form-control" >{{$terms->condition_text_ar ? $terms->condition_text_ar : '' }}</textarea>
            </div>
            @endif

        </div>
    </div>

    <!--end::Content container-->
@endsection
