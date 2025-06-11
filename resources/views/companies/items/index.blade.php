@extends('admin_panel.layout.master')

@section('title')
    {{ __('admin.products') }}
@endsection

@push('header')
@endpush

@section('content')
    <style>
        .form-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 equal columns */
            gap: 20px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: repeat(2, 1fr); /* fallback to 2 per row */
            }
        }

        @media (max-width: 480px) {
            .form-grid {
                grid-template-columns: 1fr; /* stack on very small screens */
            }
        }

    </style>
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!-- Page Header -->
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-8 col-auto">
                    <h3 class="page-title">{{ __('admin.products') }}</h3>
                </div>
             <!--    <div class="col-sm-4 col btn-add-end">
                    <a href="{{route('admin-panel.items.save')}}" class="btn btnColor float-end mt-2">{{ __('admin.add') }} {{ __('admin.product') }}</a>
                </div> -->
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
                <div class="form-grid">
                    <div class="form-group">
                        <label for="from_date">Minimum Date:</label>
                        <input type="date" id="from_date" name="from_date" onchange="update_datatable()">
                    </div>
                    <div class="form-group">
                        <label for="to_date">Maximum Date:</label>
                        <input type="date" id="to_date" name="to_date" onchange="update_datatable()">
                    </div>

                    <div class="form-group">
                        <label for="service_id">Select Service:</label>
                        <select name="service_id" id="service_id" onchange="update_datatable()">
                            <option value="">-- Select Service --</option>
                            @isset($services)
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="center_id">Select Branch:</label>
                        <select name="center_id" id="center_id" onchange="update_datatable()">
                            <option value="">-- Select Branch --</option>
                            @isset($branches)
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="item_id">Select Product:</label>
                        <select name="item_id" id="item_id" onchange="update_datatable()">
                            <option value="">-- Select Product --</option>
                            @isset($items)
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="brand_id">Select Brand:</label>
                        <select name="brand_id" id="brand_id" onchange="update_datatable()">
                            <option value="">-- Select Brand --</option>
                            @isset($brands)
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-center my-4">
                    <div class="p-3 bg-light border rounded shadow-sm text-center">
                        <h5 class="mb-0">Total Meters Used: <span id="totalMetersUsed" class="fw-bold text-primary">0</span></h5>
                    </div>
                </div>
                <table class="table align-middle table-row-dashed fs-6 gy-5 ajax-data-table">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">{{ __('common.ref') }}</th>
                            <th class="min-w-125px">{{ __('common.product_name') }}</th>
                            <th class="min-w-125px">{{ __('common.brand_name') }}</th>
                            <th class="min-w-125px">{{ __('common.meters_used') }}</th>
                            <th class="min-w-125px">{{ __('common.create_at') }}</th>
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
    <!-- Add after DataTables JS files -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <!-- ✅ These are REQUIRED for PDF export to work properly -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>


    <script>
        let minDate, maxDate, totalMetersUsed = 0;

            // Custom filtering function which will search data in column four between two values

        var columns = [{
            data: 'item_id',
            name: 'item_id',
            className: "text-center",
        },
        {
            data: 'item_name',
            name: 'item_name',
            className: "text-start",
        },
        {
            data: 'brand_name',
            name: 'brand_name',
            className: "text-start",
        },

        {
            data: 'meters_used',
            name: 'meters_used',
            className: "text-start",
        },
         {
            data: 'created_at',
            name: 'created_at',
            className: "text-start",
        },
        ];
        /*customize: function (doc) {
            const fromDate = $('#from_date').val() || 'All';
            const toDate = $('#to_date').val() || 'All';
            const itemId = $('#item_id option:selected').text() || 'All';
            const brandId = $('#brand_id option:selected').text() || 'All';
            const serviceId = $('#service_id option:selected').text() || 'All';
            const centerId = $('#center_id option:selected').text() || 'All';

            const filters = `
                   Filters:
                   From Date: ${fromDate}
                   To Date: ${toDate}
                   Item: ${itemId}
                   Brand: ${brandId}
                   Service: ${serviceId}
                   Center: ${centerId}
           `;

            doc.content.splice(0, 0,
                {
                    text: filters,
                    margin: [0, 0, 0, 12],
                    alignment: 'left',
                    fontSize: 10
                },
                {
                    text: 'Total Meters Used: ' + totalMetersUsed,
                    margin: [0, 0, 0, 12],
                    alignment: 'left',
                    bold: true,
                    fontSize: 12
                }
            );
        }*/

        var ajax_url = "{!! route('companies.reports.products') !!}";

        $(function () {
             $datatable = $('.ajax-data-table').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                scrollX: true,
                columns: columns,
                dom: '<"row mb-3"<"col-sm-6"B><"col-sm-6"l>>' +
                 '<"row"<"col-sm-12"tr>>' +
                 '<"row mt-2"<"col-sm-6"i><"col-sm-6"p>>',
                 buttons: [
                  /*   {
                         extend: 'pdfHtml5',
                         text: 'Export PDF',
                         title: 'Items Report',
                         orientation: 'landscape',
                         pageSize: 'A4',
                         exportOptions: {
                             columns: ':visible'
                         },
                         action: function (e, dt, button, config) {
                             fetchAllAndExport(dt, button, config, 'pdf');
                         },
                     },*/
                     {
                         extend: 'print',
                         text: 'Print PDF',
                         title: 'Items Report',
                         exportOptions: {
                             columns: ':visible'
                         },
                         action: function (e, dt, button, config) {
                             fetchAllAndExport(dt, button, config, 'print');
                         }
                     }
                 ],
                 ajax: {
                     url: ajax_url,
                     dataSrc: function (json) {
                         totalMetersUsed = json.total_meters_used;
                         $('#totalMetersUsed').text(totalMetersUsed);
                         return json.data;
                     }
                 }
                });

                $("#searchbox").keyup(function () {
                    $datatable.search(this.value).draw();
                });
            return $datatable;
        });

        function update_datatable() {
            ajax_url = "{!! route('companies.reports.products') !!}" +
                '?from_date=' + $('#from_date').val() +
                '&to_date=' + $('#to_date').val() +
                '&item_id=' + $('#item_id').val()+
                '&service_id=' + $('#service_id').val()+
                '&brand_id=' + $('#brand_id').val()+
                '&center_id=' + $('#center_id').val();
            $('.ajax-data-table').DataTable().ajax.url(ajax_url).load();
        }

        function fetchAllAndExport(dt, button, config, type) {
            let oldStart = dt.settings()[0]._iDisplayStart;

            let fromDate = $('#from_date').val();
            let toDate = $('#to_date').val();
            var branchId = $('#center_id').val();
            var branch = 'All'; // Default value

            if (branchId) {
                let selectedOption = $('#center_id option:selected').text().trim();
                branch = selectedOption || 'Unknown';
            }
            @php
                $company = auth()->guard('company')->user();
                $companyPicturePath = $company ? asset('storage/' . $company->profile_picture) : '';
            @endphp
            let profile_picture = "{{ $companyPicturePath }}";
            let logoHTML = `
                <div style="text-align: center; margin-bottom: 20px;">
                    <img src="${profile_picture}" style="height: 100px; width: 100px" alt="Logo">
                </div>
            `;
            let comName = "{{$company->company_name}}"

            if (type === 'print') {
                config.messageTop = logoHTML+ `
                <table style="font-size:14px; margin: 30px auto; border-collapse: collapse; width: auto; text-align: left;">
                    <thead>
                        <tr>
                            <th style="padding: 5px 15px; font-weight: bold;">company name</th>
                            <th style="padding: 5px 15px; font-weight: bold;">meter used</th>
                            <th style="padding: 5px 15px; font-weight: bold;">Branch</th>
                            <th style="padding: 5px 15px; font-weight: bold;">From Date</th>
                            <th style="padding: 5px 15px; font-weight: bold;">To Date</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 5px 15px;">${comName || 'N/A'}</td>
                            <td style="padding: 5px 15px;">${totalMetersUsed || 'N/A'}</td>
                            <td style="padding: 5px 15px;">${branch || 'N/A'}</td>
                            <td style="padding: 5px 15px;">${fromDate || 'N/A'}</td>
                            <td style="padding: 5px 15px;">${toDate || 'N/A'}</td>
                        </tr>
                    </tbody>
                </table>
                `;
            }
            dt.one('preXhr', function (e, s, data) {
                data.start = 0;
                data.length = 2147483647;

                dt.one('preDraw', function (e, settings) {
                    let json = settings.json;
                    if (type === 'print') {
                        $.fn.dataTable.ext.buttons.print.action.call(this, e, dt, button, config);
                    }

                    // Restore old state
                    dt.one('preXhr', function (e, s, data) {
                        data.start = oldStart;
                    });

                    setTimeout(dt.ajax.reload, 0);
                    return false;
                });
            });

            dt.ajax.reload();
        }

        $.fn.dataTable.ext.errMode = 'none';
    </script>
    <script>
        $(document).ready(function () {
            $('#brand_id').on('change' , function(){
                var brand = $(this).val();
                $.ajax({
                    url: '{{route('companies.get-items-by-brand')}}', // Your endpoint here
                    type: 'GET',
                    data: { brand_id: brand },
                    success: function(response) {
                        if (!response || response.product.length === 0) {
                            alert('No items found for this brand.');
                            $('#item_id').empty().append('<option value="">-- No Items Available --</option>');
                            return;
                        }
                        console.log(response.product.length)
                        $('#item_id').empty();

                        $('#item_id').append('<option value="">-- Select Product --</option>');
                        response.product.forEach(function(item) {
                            $('#item_id').append('<option value="' + item.id + '">' + item.item_name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching items:', error);
                        alert('Failed to retrieve items. Please try again.');
                    }
                });
            });

            $('#service_id').on('change' , function(){
                var service = $(this).val();
                $.ajax({
                    url: '{{route('companies.get-brands-by-service')}}', // Your endpoint here
                    type: 'GET',
                    data: { service_id: service },
                    success: function(response) {
                        if (!response || response.brands.length === 0) {
                            alert('No brands found for this service.');
                            $('#brand_id').empty().append('<option value="">-- No Items Available --</option>');
                            return;
                        }
                        console.log(response.brands.length)
                        $('#brand_id').empty();

                        $('#brand_id').append('<option value="">-- Select Brand --</option>');
                        response.brands.forEach(function(brand) {
                            $('#brand_id').append('<option value="' + brand.id + '">' + brand.brand_name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching items:', error);
                        alert('Failed to retrieve items. Please try again.');
                    }
                });
            });


        })
    </script>

@endpush
