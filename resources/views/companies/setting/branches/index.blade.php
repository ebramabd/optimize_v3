@extends('admin_panel.layout.master')

@section('title')
    {{ __('common.company_branches') }}
@endsection

@push('header')
@endpush

@section('content')
    <!-- Main Content -->
    <div class="p-7">
        <h1 class="home-h1 mb-8">{{ __('common.settings') }} / {{ __('common.company_branches') }}</h1>

        <div class="card p-4 mb-4">
            <div class="home-subscription d-flex align-items-end">
                <img src="{{ asset('assets/imgs/hub.png') }}" style="transform: rotate(270deg);">
                <h5 class="service-h5" style="margin-bottom: 3px">{{ __('common.company_branches') }}</h5>
            </div>

            <div class="p-8">
                <a  href="{{ route('companies.setting.company.add.branch') }}" class="link-box">
                    {{ __('common.add_branches') }}
                </a>
            </div>

            <div class="p-8">
                <div class="branch-card p-4">
                    @isset($branches)
                        @foreach($branches as $branch)
                            <div class="branch-item p-2 d-flex align-items-center justify-content-between">
                                <h5 class="mb-0 fw-normal">{{$branch->branch_name}}</h5>
                                <a href="{{route('companies.setting.company.edit.branch' , $branch->id)}}"
                                   class="work-stages-btn-edit"
                                   style="padding: 3px 20px !important;font-size: 12px !important;margin: 10px !important;">
                                    <i class='far fa-edit' style='font-size:12px'></i>
                                    {{ __('common.edit') }}
                                </a>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </div>
    <!--end::Content container-->
@endsection
