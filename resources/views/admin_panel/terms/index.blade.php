@extends('admin_panel.layout.master')

@section('title')
    {{ __('common.terms_agreement') }}
@endsection

@push('header')
@endpush

@section('content')
    <style>
        .form-check-input {
            width: 1.2em;
            height: 1.2em;
            margin-top: 0.2em;
        }

        .form-check-label {
            font-size: 1rem;
            margin-left: 0.5rem;
            color: #333;
        }

        .form-check-input:checked {
            background-color: #0d6efd; /* Bootstrap primary */
            border-color: #0d6efd;
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.25);
        }
    </style>
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!-- Page Header -->
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-8 col-auto">
                    <h3 class="page-title">{{ __('common.terms_agreement') }}</h3>
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
            <div class="mb-4" style="text-align: center">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" style="display: flow" name="service_filter" id="all_services" value="all" checked>
                    <label class="form-check-label fw-semibold" for="all_services">
                        All Terms
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" style="display: flow" name="service_filter" id="specific_services" value="specific">
                    <label class="form-check-label fw-semibold" for="specific_services">
                        Default Terms
                    </label>
                </div>
            </div>
            <div class="card-body pt-0">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5 ajax-data-table">
                    <thead>
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-125px">#</th>
                        <th class="min-w-125px">{{ __('admin.text') }} {{ __('admin.terms') }}</th>
                        <th class="min-w-125px">{{ __('admin.text') }} {{ __('admin.branch') }}</th>
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
            data: 'condition_text',
            name: 'condition_text',
            className: "text-start",
        },
        {
            data: 'company_name',
            name: 'company_name',
            className: "company_name",
        },
        {
            data: 'action',
            name: 'action',
            className: "text-center",
            orderable: false,
            searchable: false
        },
        ];

        var ajax_url = "{!! route('admin-panel.terms.index') !!}";

        let table;

        function loadDataTable(filter = 'all') {
            if (table) {
                table.destroy();
            }

            table = $('.ajax-data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: ajax_url,
                    data: function (d) {
                        d.filter = filter;
                    }
                },
                columns: columns,
            });
        }

        $(function () {
            // Initial load
            loadDataTable();

            // Reload on radio change
            $('input[name="service_filter"]').on('change', function () {
                let selectedFilter = $(this).val();
                loadDataTable(selectedFilter);
            });
        });

        $.fn.dataTable.ext.errMode = 'none';
    </script>

@endpush
