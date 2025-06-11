@extends('admin_panel.layout.master')

@section('title')
    {{ __('common.settings') }}
@endsection

@push('header')
@endpush

@section('content')
    <style>

        /* Main Content */
        .main-content {
            padding: 20px;
        }

        /* Settings Card */
        .settings-card {
            /*background: white; */
            border-radius: 10px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            /* box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1); */
            cursor: pointer;
            margin-bottom: 13px;
           
        }

        .settings-card:hover {
            background: #f0f4f8;
        }

        .settings-card i {
            font-size: 18px;
            color: #7a7a7a;
        }
        .no-effect {
            text-decoration: none;
            color: inherit;
            background: none;
            border: none;
            outline: none;
        }

    </style>
    <!-- Main Content -->
    <div class="main-content">
        <div class="settings-container">
            <a class="no-effect" href="{{route('companies.setting.terms')}}">
                <div class="settings-card"><i class="fas fa-file-alt"></i>{{ __('common.terms_agreement') }}</div>
            </a>

            <a class="no-effect" href="{{route('companies.setting.profile')}}">
                <div class="settings-card"><i class="fas fa-user"></i>{{ __('common.profile') }}</div>
            </a>

            <a class="no-effect" href="{{route('companies.setting.service')}}">
                <div class="settings-card"><i class="fas fa-cogs"></i>{{ __('common.services') }}</div>
            </a>

            <a class="no-effect" href="{{route('companies.setting.company_branches')}}">
                <div class="settings-card"><i class="fas fa-building"></i> {{ __('common.company_branches') }}</div>
            </a>

            <a class="no-effect" href="{{route('companies.setting.administrator')}}">
                <div class="settings-card"><i class="fas fa-users"></i>{{ __('common.system_administrators') }}</div>
            </a>

            <a class="no-effect"  href="{{route('companies.setting.subscriptions')}}">
                <div class="settings-card"><i class="fas fa-subscript"></i>{{ __('common.subscriptions') }} </div>
            </a>

            <div class="lang-div settings-card no-effect" href="{{route('welcome')}}">
                <div class="d-flex"><i class="fas fa-language"></i>{{ __('common.language') }}</div>

                <div>
                    <a href="{{ route('lang.switch', 'en') }}" class="btn-lang {{ app()->getLocale() === 'en' ? 'btn-lang-active' : '' }}">{{ __('common.en') }}</a>
                    <a href="{{ route('lang.switch', 'ar') }}" class="btn-lang {{ app()->getLocale() === 'ar' ? 'btn-lang-active' : '' }}">{{ __('common.ar') }}</a>
                </div>
            </div>
        </div>
    </div>
    <!--end::Content container-->
@endsection
