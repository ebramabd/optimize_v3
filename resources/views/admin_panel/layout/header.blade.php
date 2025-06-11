<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<!--begin::Head-->
<head>
    <title>@yield('title', 'dashboard')</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Dashboard" />
    <meta property="og:site_name" content="Dashboard" />
    <link rel="shortcut icon" href="{{url('design/admin')}}/assets/media/logos/favicon.ico" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

    {{--CSS FILES--}}
    <link href="{{url('design/admin')}}/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{url('design/admin')}}/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{url('design/admin')}}/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('design/admin/assets/css/' . (app()->getLocale() === 'ar' ? 'custom_ar.css' : 'custom.css')) }}"
          rel="stylesheet" type="text/css" />
    <link href="{{url('design/admin')}}/assets/css/my_design.css" rel="stylesheet" type="text/css" />

        <!--end::Global Stylesheets Bundle-->
    @stack('header')
</head>
<!--end::Head-->
