<!--begin::Footer-->
<div id="kt_app_footer" class="app-footer">
    <!--begin::Footer container-->
    <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted fw-semibold me-1">2023&copy;</span>
            <a href="{{--{{url(target())}}--}}" target="_blank" class="text-gray-800 text-hover-primary">{{config('settings.app_name')}}</a>
        </div>
        <!--end::Copyright-->
        <!--begin::Menu-->
        <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
            <li class="menu-item">
                <a href="{{url('/')}}" target="_blank" class="menu-link px-2">About</a>
            </li>
            <li class="menu-item">
                <a href="{{url('/')}}" target="_blank" class="menu-link px-2">Support</a>
            </li>
            <li class="menu-item">
                <a href="{{url('/')}}" target="_blank" class="menu-link px-2">Purchase</a>
            </li>
        </ul>
        <!--end::Menu-->
    </div>
    <!--end::Footer container-->
</div>
<!--end::Footer-->

</div>
<!--end:::Main-->
</div>
<!--end::Wrapper-->
</div>
<!--end::Page-->
<!-- Mouse Cursor start -->
<div class="mouse-move mouse-outer"></div>
<div class="mouse-move mouse-inner"></div>
<!-- Mouse Cursor Ends -->
</div>
<!--end::App-->

<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{url('design/admin')}}/assets/plugins/global/plugins.bundle.js"></script>
<script src="{{url('design/admin')}}/assets/js/scripts.bundle.js"></script>
<script src="{{url('design/assets/js/helper.js')}}"></script>
<script src="{{url('design/admin')}}/assets/js/custom.js"></script>
<script src="{{url('design/admin')}}/assets/js/signature_pad.min.js"></script>

<!--end::Global Javascript Bundle-->
@stack('footer')
</body>
<!--end::Body-->

</html>
