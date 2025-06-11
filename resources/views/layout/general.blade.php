<!DOCTYPE html>
<html lang="en">
<head>
{{--    @include('admin_panel.layout.message')--}}
    @include('layout.src.head-links')
    @yield('style')
</head>
<body>
@include('admin_panel.layout.message')
<input type="hidden" id="csrf-input" value="{{csrf_token()}}">
<input type="hidden" id="url-input" value="{{ url('/') }}">
{{--Main Content--}}
@yield('content')
{{--End Main Content--}}

@include('layout.src.js-scripts')
@yield('scripts')

</body>
</html>
