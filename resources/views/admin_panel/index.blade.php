@extends('admin_panel.layout.master')

@section('title')
    {{ __('admin.dashboard') }}
@endsection

@push('header')
@endpush

@section('content')
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <h1>{{ __('admin.welcome_dash') }}</h1>
    </div>
    <!--end::Content container-->
@endsection
