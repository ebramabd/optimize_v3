
<style>
    .sidebar {
        /*position: absolute;*/
        /*top: 298px;*/
        /*left: 0;*/
        /*width: 615px;*/
        /*height: 93px;*/
    {{--background: transparent url('{{asset('assets/imgs/house-blank.svg')}}') 0% 0% no-repeat padding-box;--}}
/*opacity: 1;*/
        /*display: flex;*/
        /*align-items: center;*/
        /*padding-left: 20px;*/
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        gap: 20px;
    }

    .sidebar li {
        display: flex;
        align-items: center;
        gap: 10px;
        color: white;
        font-size: 18px;
        cursor: pointer;
    }

    .sidebar i {
        font-size: 22px;
    }

    .house-svg {
        width: 23px;
        height: 40px;
    }

    .title {
        font-weight: 300 !important;
        color: #ffffff !important;
    }

    .no-effect {
        text-decoration: none;
        color: inherit;
        background: none;
        border: none;
        outline: none;
    }

   /* Styling for the links */
.app-sidebar-menu a {
    text-decoration: none;

    border-radius: 0px;
    font-size: 1.2rem;
    transition: background-color 0.3s ease, transform 0.3s ease;
    transform: translateX(-5px); /* Initial position for animation */
}
/* Hover effect */
.app-sidebar-menu a:hover {
    background-color: rgba(229, 240, 255, 0.19); /* Red background on hover */
    transform: translateX(0); /* Slide to normal position */
}

/* Active menu item style */
.menu-item.active a {
    background-color: rgba(229, 240, 255, 0.19);
}

/* Simple animation for menu expansion */
.menu-item:hover .menu-sub {
    display: block;
    animation: slideIn 0.3s ease forwards; /* Simple slide-in animation */
}

</style>

<!--begin::Wrapper-->
<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
    <!--begin::Sidebar-->
    <div id="kt_app_sidebar" class="app-sidebar flex-column no-print {{ app()->getLocale() === 'ar' ? 'kt-app-sidebar-rtl' : '' }}" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
        <!--begin::Logo-->
        <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
            <!--begin::Logo image-->
            <a href="{{--{{url(target())}}--}}">
                <!-- <img alt="Logo" src="{{url('design/admin')}}/assets/media/logos/default-dark.svg" class="h-25px app-sidebar-logo-default" /> -->
                <!-- <img alt="Logo" src="{{url('design/admin')}}/assets/media/logos/default-small.svg" class="h-20px app-sidebar-logo-minimize" /> -->
                {{--<h3 class="text-white">{{config('settings.app_name')}}</h3>--}}
                <img alt="Logo" src="{{ asset('assets/imgs/logo_color.svg') }}" class="h-55px w-125px app-sidebar-logo-default" />
            </a>
            <!--end::Logo image-->
            <!--begin::Sidebar toggle-->
            <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 {{ app()->getLocale() === 'ar' ? 'd-none': '' }} translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
                <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
            <!--end::Sidebar toggle-->
        </div>
        <!--end::Logo-->
        <!--begin::sidebar menu-->
        <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
            <!--begin::Menu wrapper-->
            <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
                <!--begin::Scroll wrapper-->
                <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">

                    @role('admin_panel')

                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                            <!--begin::Logo image-->
                            <a href="{{route('admin_panel.home')}}">
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-element-11 fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title" style="font-size: 1.5rem">{{ __('admin.dashboard') }}</span>
                                    <span class="menu-arrow"></span>
                                </span>
                            </a>
                            <!--end::Logo image-->
                        </div>
                    </div>

                    <!--begin::Menu Users-->
                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-element-11 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">{{ __('admin.users') }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="{{route('admin-panel.users.index')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('admin.all_users') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end::Menu Users-->

                    <!--begin::Menu Companies-->
                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-element-11 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">{{ __('admin.companies') }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="{{route('admin-panel.companies.index')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('admin.all_companies') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end::Menu Companies-->

                    <!--begin::Menu Brand-->
                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-element-11 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">{{ __('admin.brands') }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="{{route('admin-panel.brands.index')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('admin.all_brands') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end::Menu Brand-->

                    <!--begin::Menu item-->
                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-element-11 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">{{ __('admin.products') }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="{{route('admin-panel.items.index')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('admin.all_products') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu service-->
                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-element-11 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">{{ __('common.services') }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="{{route('admin-panel.services.index')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('admin.all_services') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end::Menu service-->


                    <!--begin::Menu subscription-->
                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-element-11 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">{{ __('common.subscriptions') }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="{{route('admin-panel.subscriptions.index')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('admin.all_subscriptions') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="{{route('admin-panel.subscriptions.companies')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Companies Subscription</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end::Menu subscription-->


                    <!--begin::Menu subscription-->
                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-element-11 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">{{ __('common.car_form') }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="{{route('admin-panel.process-service.index')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('admin.all_process') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end::Menu subscription-->

                    <!--begin::Menu Terms-->
                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-element-11 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">{{ __('common.terms_agreement') }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="{{route('admin-panel.terms.index')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('admin.all_terms') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                    </div>

                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <!--begin:Menu item-->
                        <div  class="menu-item here menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-element-11 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </span>
                                <a href="{{route('admin-panel.bank.index')}}">
                                    <span class="menu-title">Bank Account</span>
                                </a>
                            </span>
                            <!--end:Menu link-->

                            <!--begin:Menu sub-->
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                    </div>

                    @endrole

                    <!--end::Menu Terms-->


                    @role('admin_company', 'company')
                    <!--begin::Menu Home Company-->
                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <!--begin:Menu item-->
                        <a href="{{route('companies.home')}}">
                            <div class="menu-item here menu-accordion">
                                <!--begin:Menu link-->
                                <span class="menu-link  {{ Route::is('companies.home') ? 'active custom-red' : '' }}" href="{{ route('companies.home') }}">

                                    <span class="menu-icon">
                                        <img class="house-svg" src="{{ asset('assets/imgs/house-blank.svg') }}" alt="house-svg">
                                    </span>

                                    <span class="title menu-title">
                                         <div class="no-effect mx-2"> {{ __('common.home') }} </div>
                                    </span>
                                </span>
                                <!--end:Menu link-->
                            </div>
                        </a>
                        <!--end:Menu item-->
                    </div>
                    <!--end::Menu Home Company-->

                    <!--begin::Menu car form Company-->
                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <!--begin:Menu item-->
                        <a href="{{route('companies.car-form')}}">
                            <div  class="menu-item here menu-accordion">
                                <!--begin:Menu link-->
                                <span class="menu-link {{ Route::is('companies.car-form') ? 'active custom-red' : '' }}" href="{{ route('companies.car-form') }}">
                                <span class="menu-icon">
                                    <img class="house-svg" src="{{ asset('assets/imgs/car-alt.svg') }}" alt="house-svg">
                                </span>

                                <span class="title menu-title">
                                     <div class="no-effect mx-2"> {{ __('common.car_form') }} </div>
                                </span>
                            </span>

                                <!--end:Menu link-->

                            </div>
                        </a>
                        <!--end:Menu item-->
                    </div>
                    <!--end::Menu car form Company-->

                    <!--begin::Menu Work Stages Company-->
                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <!--begin:Menu item-->
                        <a href="{{route('companies.work_stages')}}">
                            <div  class="menu-item here menu-accordion">
                                <!--begin:Menu link-->
                                <span class="menu-link {{ Route::is('companies.work_stages') ? 'active custom-red' : '' }}" href="{{ route('companies.work_stages') }}">
                                    <span class="menu-icon">
                                        <img class="house-svg" src="{{ asset('assets/imgs/dashboard-monitor.svg') }}" alt="house-svg">
                                    </span>

                                    <span class="title menu-title">
                                         <div class="no-effect mx-2">{{ __('common.work_stages') }}</div>
                                    </span>
                                </span>
                                <!--end:Menu link-->
                            </div>
                        </a>
                        <!--end:Menu item-->
                    </div>
                    <!--end::Menu Work Stages Company-->

                    <!--begin::Menu Reports Company-->
                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <!--begin:Menu item-->
                        <a href="{{route('companies.reports.products')}}">
                            <div class="menu-item here menu-accordion">
                                <!--begin:Menu link-->
                                <span class="menu-link {{ Route::is('companies.reports.products') ? 'active custom-red' : '' }}" href="{{ route('companies.reports.products') }}">
                                    <span class="menu-icon">
                                        <img class="house-svg" src="{{ asset('assets/imgs/big-data-analytics.svg') }}" alt="house-svg">
                                    </span>

                                    <span class="title menu-title">
                                         <div class="no-effect mx-2"> {{ __('common.reports') }} </div>
                                    </span>
                                </span>
                                <!--end:Menu link-->
                            </div>
                        </a>
                        <!--end:Menu item-->
                    </div>
                    <!--end::Menu Reports Company-->

                    <!--begin::Menu Waranty Company-->
                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <!--begin:Menu item-->
                        <div  class="menu-item here menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <img class="house-svg" src="{{ asset('assets/imgs/features-alt.svg') }}" alt="house-svg">
                                </span>

                                <span class="title menu-title">
                                     <a href="#" class="no-effect mx-2"> {{ __('common.warranty') }} </a>
                                </span>
                            </span>

                            <!--end:Menu link-->

                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end::Menu Waranty Company-->

                    <!--begin::Menu Settings Company-->
                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <!--begin:Menu item-->
                        <a href="{{route('companies.setting')}}">
                            <div  class="menu-item here menu-accordion">
                                <!--begin:Menu link-->
                                <span class="menu-link {{ Route::is('companies.setting') ? 'active custom-red' : '' }}" href="{{ route('companies.setting') }}">
                                <span class="menu-icon">
                                    <img class="house-svg" src="{{ asset('assets/imgs/customize.svg') }}" alt="house-svg">
                                </span>

                                <span class="title menu-title">
                                     <div class="no-effect mx-2"> {{ __('common.settings') }} </div>
                                </span>
                            </span>

                                <!--end:Menu link-->
                            </div>
                        </a>
                        <!--end:Menu item-->
                    </div>
                    <!--end::Menu Precut Software Company-->

                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <!--begin:Menu item-->
                        <div  class="menu-item here menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
{{--                                <span class="menu-icon">--}}
                                {{--                                    <img class="house-svg" src="{{ asset('assets/imgs/customize.svg') }}" alt="house-svg">--}}
                                {{--                                </span>--}}

                                <span class="title menu-title">
                                     <a href="{{route('download.pdf.patternauto')}}" class="no-effect mx-2"> Precut Software </a>
                                </span>
                            </span>

                            <!--end:Menu link-->

                        </div>
                        <!--end:Menu Precut Software item-->
                    </div>

                    @endrole


                </div>
                <!--end::Scroll wrapper-->
            </div>
            <!--end::Menu wrapper-->
        </div>
        <!--end::sidebar menu-->
    </div>
    <!--end::Sidebar-->
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid {{ app()->getLocale() === 'ar' ? 'kt-app-main-rtl' : '' }}" id="kt_app_main">

