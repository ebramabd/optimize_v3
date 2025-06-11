@include('admin_panel.layout.header')
@include('admin_panel.layout.navbar')
@include('admin_panel.layout.sidebar')

@include('admin_panel.layout.message')
<!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        @yield('content')
    </div>
    <!--end::Content-->
</div>
<!--end::Content wrapper-->
@include('admin_panel.layout.footer')
