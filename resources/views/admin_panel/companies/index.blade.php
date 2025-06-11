@extends('admin_panel.layout.master')

@section('title')
    {{ __('admin.companies') }}
@endsection

@push('header')
@endpush

@section('content')
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!-- Page Header -->
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-8 col-auto">
                    <h3 class="page-title">{{ __('admin.users') }}</h3>
                </div>
                <div class="col-sm-4 col btn-add-end">
                    <a href="{{route('admin-panel.companies.save')}}" class="btn btnColor float-end mt-2">{{ __('admin.add') }} {{ __('admin.company') }}</a>
                </div>
            </div>
        </div>

        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="search" id="searchbox" class="form-control form-control-solid w-250px ps-12"
                               placeholder="{{ __('admin.search') }}"/>
                    </div>
                    <!--end::Search-->
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5 ajax-data-table">
                    <thead>
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-125px">#</th>
                        <th class="min-w-125px">{{ __('common.company_name') }}</th>
                        <th class="min-w-125px">{{ __('common.trade_name') }}</th>
                        <th class="min-w-125px">{{ __('common.owner_name') }}</th>
                        <th class="min-w-125px">{{ __('admin.action') }}</th>
                    </tr>
                    </thead>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Content container-->
@endsection

@push('footer')
    <script src="{{ url('design/admin/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        var columns = [{
            data: 'id',
            name: 'id',
            className: "text-center",
        },
            {
                data: 'company_name',
                name: 'company_name',
                className: "text-start",
            },
            {
                data: 'trade_name',
                name: 'trade_name',
                className: "text-start",
            },
            {
                data: 'owner_name',
                name: 'owner_name',
                className: "text-start",
            },
            {
                data: 'action',
                name: 'action',
                className: "text-center",
                orderable: false,
                searchable: false
            },
        ];

        console.log(columns);

        var ajax_url = "{!! route('admin-panel.companies.index') !!}";

        $(function () {
            createDatatable(columns, ajax_url);
        });

        $.fn.dataTable.ext.errMode = 'none';
    </script>

@endpush
