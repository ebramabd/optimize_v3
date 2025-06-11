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
    <div class="card-terms">
        <div class="home-subscription d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-end">
                <img src="{{ asset('assets/imgs/user-pen.svg') }}">
                <h5>Bank Account</h5>
            </div>
        </div>
        <div style="padding-top: 24px;padding-bottom: 43px;">
            <form enctype="multipart/form-data" method="POST" action="{{ route('admin-panel.bank.edit') }}">
                @csrf
                @isset($bank)
                <textarea name="bank_account" class="form-control" rows="20" style="font-family: monospace; resize: none; height: 200px; background-color: #f8f9fa;">
                {{ $bank->bank_account }}
                </textarea>
                @endisset
                <div class="modal-footer flex-center pt-8 pb-10">
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label" style="color: #2FB593;">save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


    <!--end::Content container-->
@endsection
