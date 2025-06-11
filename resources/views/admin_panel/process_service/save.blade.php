{{--
@extends('admin_panel.layout.master')
@section('title')
    {{ __('common.car_form') }}
@endsection

@push('header')
@endpush

@section('content')

    <div class="p-7 my-4">
        <div class="container-box-car-form">
            <!-- Client Information -->
            <form class="form"
                  action="{{ route('admin-panel.process-service.save_post' ,object_id($object))}}"
                  enctype="multipart/form-data"
                  method="post">
                @csrf
                <div class="section-title">{{ __('common.client_info') }}</div>
                <input type="hidden" value="{{object_id($client)}}" name="client_edit">

                <div class="row g-3">
                    <div class="col-md-6">
                        <input
                            type="text" name="name"
                            class="form-control" placeholder="{{ __('common.first_name') }}"
                            value="{{field_value2($client , 'name')}}"
                        >
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="last_name"
                               class="form-control" placeholder="{{ __('common.last_name') }}"
                               value="{{field_value2($client , 'last_name')}}"
                        >
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <input type="text" name="phone"
                               class="form-control" placeholder="{{ __('common.phone') }}"
                               value="{{field_value2($client , 'phone')}}"
                        >
                    </div>

                    <div class="col-md-6">
                        <input type="email" name="email"
                               class="form-control" placeholder="{{ __('common.email') }}"
                               value="{{field_value2($client , 'email')}}"
                        >
                    </div>
                </div>

                <!-- Car Information -->
                <div class="section-title-car-form mt-4">{{ __('common.car_info') }}</div>
                <input type="hidden" value="{{object_id($car)}}" name="car_edit">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ __('common.car_type') }}</label>
                        <input type="text" name="type"
                               class="form-control" placeholder="{{ __('common.car_type') }}"
                               value="{{field_value2($car , 'type')}}"
                        >
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('common.cate') }}</label>
                        <input type="text" name="category"
                               class="form-control" placeholder="{{ __('common.cate') }}"
                               value="{{field_value2($car , 'category')}}"
                        >
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('common.color') }}</label>
                        <input type="text" name="color"
                               class="form-control" placeholder="{{ __('common.color') }}"
                               value="{{field_value2($car , 'color')}}"
                        >
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('common.year_manufacture') }}</label>
                        <input type="text" name="year_of_manufacture"
                               class="form-control" placeholder="{{ __('common.year_manufacture') }}"
                               value="{{field_value2($car , 'year_of_manufacture')}}"
                        >
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('common.plate_no') }}</label>
                        <div class="d-flex">
                            <input type="text" name="plate_number"
                                   class="form-control me-2" placeholder="1234"
                                   value="{{field_value2($car , 'plate_number')}}"
                            >
--}}
{{--                            <input type="text" class="form-control plate-input me-2" placeholder="A">--}}{{--

--}}
{{--                            <input type="text" class="form-control plate-input me-2" placeholder="B">--}}{{--

--}}
{{--                            <input type="text" class="form-control plate-input" placeholder="C">--}}{{--

                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('common.car_meter_read') }}</label>
                        <div class="d-flex align-items-center">
                            <input type="text" name="meter_reading"
                                   class="form-control me-2" placeholder=""
                                   value="{{field_value2($car , 'meter_reading')}}"
                            >
                            <span class="km-label-car-form">{{ __('common.km') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Services -->
                <div class="section-title-car-form mt-4">{{ __('common.services') }}</div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <select name="service_id" class="form-select" id="service-select">
                            <option selected>{{ __('admin.select') }} {{ __('admin.service') }}</option>
                            @isset($services)
                                @foreach($services as $service)
                                    <option value="{{$service->id}}">{{$service->service_name}}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>

                    <div class="col-md-6">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('admin.select') }} {{ __('admin.product') }}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @isset($items)
                                    @foreach($items as $item)
                                        <li class="px-3">
                                            <label class="category-car-form ">
                                                <input type="checkbox" class="brands-select parent me-2" name="brands[]" value="{{$item['brands']['brand_id']}}" id="{{$item['brands']['brand_name']}}">
                                                {{ $item['brands']['brand_name'] }}
                                            </label>

                                            @if(count($item['items']) > 0)
                                                <ul class="subcategory-car-form list-unstyled ps-3">
                                                    @foreach($item['items'] as $product)
                                                        <li>
                                                            <label>
                                                                <input type="checkbox" class="items-select child me-2" name="products[]" value="{{$product->id}}" data-parent="{{$item['brands']['brand_name']}}">
                                                                {{ $product->item_name }}
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <p class="text-muted-car-form  ps-3">{{ __('admin.no_available') }}</p>
                                            @endif
                                        </li>
                                        <hr>
                                    @endforeach
                                @endisset
                            </ul>
                        </div>
                    </div>

                    <div class="custom-select col-md-12">
                        <div class="select-box" onclick="toggleDropdown()">{{ __('admin.application_area') }} ⬇️</div>
                        <div class="options-container">
                            <label><input type="checkbox" name="application_area[]" value="Full Vehicle">{{ __('admin.full_vehicle') }}</label>
                            <label><input type="checkbox" name="application_area[]" value="Front Windshield">{{ __('admin.front_windshield') }}</label>
                            <label><input type="checkbox" name="application_area[]" value="Full Front">{{ __('admin.full_front') }}</label>
                            <label><input type="checkbox" name="application_area[]" value="Rear Windshield">{{ __('admin.rear_windshield') }} </label>
                            <label><input type="checkbox" name="application_area[]" value="Front Bumper">{{ __('admin.front_bumper') }} </label>
                            <label><input type="checkbox" name="application_area[]" value="Sunroof">{{ __('admin.sunroof') }}</label>
                            <label><input type="checkbox" name="application_area[]" value="Front Fender (R)">{{ __('admin.front_fender_r') }}</label>
                            <label><input type="checkbox" name="application_area[]" value="Front Window (R)">{{ __('admin.front_window_r') }}</label>
                            <label><input type="checkbox" name="application_area[]" value="Front Window (L)">{{ __('admin.front_window_l') }}</label>
                            <label><input type="checkbox" name="application_area[]" value="Front Fender (L)">{{ __('admin.front_fender_l') }}</label>
                            <label><input type="checkbox" name="application_area[]" value="Full Hood">{{ __('admin.full_hood') }}</label>
                            <label><input type="checkbox" name="application_area[]" value="Rear Window (R)">{{ __('admin.rear_window_r') }}</label>
                            <label><input type="checkbox" name="application_area[]" value="Rear Window (L)">{{ __('admin.rear_window_l') }}</label>
                            <label><input type="checkbox" name="application_area[]" value="Front Door (R)">{{ __('admin.front_door_r') }}</label>
                            <label><input type="checkbox" name="application_area[]" value="Front Door (L)">{{ __('admin.front_door_l') }}</label>
                            <label><input type="checkbox" name="application_area[]" value="Roof Top">{{ __('admin.roof_top') }}</label>
                            <label><input type="checkbox" name="application_area[]" value="Mpv - Rear Fix Window (R)">{{ __('admin.rear_fix_r') }}</label>
                            <label><input type="checkbox" name="application_area[]" value="Mpv - Rear Fix Window (L)">{{ __('admin.rear_fix_l') }}</label>
                        </div>
                    </div>
                </div>
                <!-- You can add service options here -->
             --}}
{{--   <div class="service-box mt-3">
                    <h6 class="fw-bold">Paint Protection</h6>
                    <p class="mb-0">The Project 3 / Alph</p>
                    <p>Full Front / Front Bumper</p>
                    <div class="row g-2">
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Price Inc Tax*">
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Serial Number">
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Warranty Code">
                        </div>
                    </div>
                </div>--}}{{--

                <div id="vehicle-container"></div>

                <div id="vehicle-card-id" class="bg-gray-300i d-none">
                    <div class="bg-light px-5">
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <th scope="row" width="50%" style="font-weight: bold">Plate No</th>
                                <td id="vehicle-plate"></td>
                            </tr>
                            <tr>
                                <th scope="row" style="font-weight: bold">Model</th>
                                <td id="vehicle-model"></td>
                            </tr>
                            <tr>
                                <th scope="row" style="font-weight: bold">Category</th>
                                <td id="vehicle-cat"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                --}}
{{-- branch --}}{{--

                <div class="section-title-car-form mt-4">{{ __('common.branches') }}</div>
                <div class="col-md-12">
                    <select class="form-select" name="branch_id" id="branch-select">
                        @isset($companies)
                            <option value="{{ $branch ? $branch->id : '' }}" selected>{{$branch == null ? 'Select The Branch' : $branch->company_name}}</option>
                            @foreach($companies as $company)
                                <option value="{{$company->id}}">{{$company->company_name}}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>

                --}}
{{-- administrator --}}{{--

                <div class="section-title-car-form mt-4">{{ __('common.administrator') }}</div>
                <div class="col-md-12">
                    <select class="form-select" name="administrator" id="admin-select">
                        @isset($administrator)
                            <option value="{{ $administrator ? $administrator->id : '' }}" selected>{{$administrator == null ? 'Select The Administrator' : $administrator->name}}</option>
                        @endisset
                        <option value="">{{ __('admin.select') }} {{ __('admin.branch') }}</option>
                    </select>
                </div>

                --}}
{{--upload images--}}{{--

                <div class="section-title-car-form mt-4">{{ __('admin.upload_image') }}</div>
                <div id="file-input-container">
                    <div class="file-input" style="padding-bottom: 10px ; padding-top: 10px" >
                        <label for="images">{{ __('admin.upload_image') }}:</label>
                        <input type="file" name="images[]" class="images" multiple>
                    </div>
                </div>

                <div class="modal-footer flex-center pt-8">
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">{{ __('common.submit') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
@push('footer')
    <script>
        $(document).ready(function() {
            $('#branch-select').change(function() {
                var branchId = $(this).val();
                if (branchId) {
                    $.ajax({
                        url: "{{ route('get-administrators') }}",
                        type: "GET",
                        data: { branch_id: branchId },
                        success: function(response) {
                            $('#admin-select').empty();
                            $('#admin-select').append('<option value="">Select an administrator</option>');

                            $.each(response, function(index, admin) {
                                $('#admin-select').append('<option value="'+ admin.id +'">'+ admin.name +'</option>');
                            });
                        }
                    });
                } else {
                    $('#admin-select').empty();
                    $('#admin-select').append('<option value="">Select an administrator</option>');
                }
            });

            document.querySelectorAll(".parent").forEach(parent => {
                parent.addEventListener("change", function() {
                    let children = document.querySelectorAll(`.child[data-parent='${this.id}']`);
                    children.forEach(child => child.checked = this.checked);
                });
            });

            document.querySelectorAll(".child").forEach(child => {
                child.addEventListener("change", function() {
                    let parent = document.getElementById(this.getAttribute("data-parent"));
                    let siblings = document.querySelectorAll(`.child[data-parent='${parent.id}']`);
                    let anyChecked = Array.from(siblings).some(sib => sib.checked);
                    parent.checked = anyChecked;
                });
            });

            //upload image
            const maxPhotos = 4;
            $(document).on('change', '.images', function () {
                const totalInputs = $('#file-input-container .file-input').length;
                if (totalInputs >= maxPhotos) {
                    $('#error-message').show();
                    return;
                } else {
                    $('#error-message').hide();
                }
                if ($(this).val() !== '') {
                    const newFileInput = `
                        <div class="file-input" style="padding-bottom: 10px ; padding-top: 10px">
                            <label for="images">Upload Images:</label>
                            <input type="file" name="images[]" class="images" multiple>
                        </div>`;
                    $('#file-input-container').append(newFileInput);
                }
            });
        });

        function toggleDropdown() {
            document.querySelector('.custom-select').classList.toggle('active');
        }

        document.addEventListener('click', function (event) {
            const select = document.querySelector('.custom-select');
            if (!select.contains(event.target)) {
                select.classList.remove('active');
            }
        });

//select service
        var items    = @json($items);
        var services = @json($services);

        $(document).ready(function () {
            var selectedData = {};

            $('#service-select').on('change', function () {
                var serviceId = parseInt($(this).val());
                var selectedService = services.find(service => service.id === serviceId);

                if (selectedService) {
                    $(`#service-card-${serviceId}`).remove();
                    selectedData = {}; // Reset selections

                    var newCard = `
                <div class="bg-light px-5 vehicle-card mt-3" id="service-card-${serviceId}">
                    <input type="hidden" name="services_ids[]" value="${selectedService.id}">
                    <input type="hidden" name="brands_ids[]" id="brands-ids-${serviceId}" value="">
                    <input type="hidden" name="items_ids[]" id="items-ids-${serviceId}" >
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th scope="row" width="50%" style="font-weight: bold">Service Name</th>
                                <td>${selectedService.service_name}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="font-weight: bold">Selected Brands & Products</th>
                                <td id="brand-product-list-${serviceId}">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            `;


                    $('#vehicle-container').append(newCard);
                }
            });

            // When a brand is selected
            $(document).on('change', '.brands-select', function () {
                var brandId = parseInt($(this).val());
                var brandName = $(this).attr('id');
                var serviceId = $('#service-select').val();

                if (!serviceId) {
                    alert("Please select a service first.");
                    $(this).prop('checked', false);
                    return;
                }

                if ($(this).is(':checked')) {
                    if (!selectedData[brandId]) {
                        selectedData[brandId] = {
                            brandId: brandId,
                            brandName: brandName,
                            products: []
                        };
                    }
                } else {
                    delete selectedData[brandId];
                }

                updateServiceCard(serviceId);
                updateHiddenInputs(serviceId);
            });

            $(document).on('change', '.items-select', function () {
                var productId = parseInt($(this).val());
                var productName = $(this).parent().text().trim();
                var brandName = $(this).data('parent');
                var brandId = $(`#${brandName}`).val();
                var serviceId = $('#service-select').val();

                if (!serviceId) {
                    alert("Please select a service first.");
                    $(this).prop('checked', false);
                    return;
                }

                if (!brandId) {
                    alert("Please select the brand first.");
                    $(this).prop('checked', false);
                    return;
                }

                var brandEntry = selectedData[brandId] || { brandId: brandId, brandName: brandName, products: [] };

                if ($(this).is(':checked')) {
                    if (!brandEntry.products.includes(productId)) {
                        brandEntry.products.push({ id: productId, name: productName });
                    }
                    selectedData[brandId] = brandEntry;
                } else {
                    brandEntry.products = brandEntry.products.filter(pid => pid !== productId);
                    if (brandEntry.products.length === 0) {
                        delete selectedData[brandId];
                    }
                }

                updateServiceCard(serviceId);
                updateHiddenInputs(serviceId);
            });

            function updateServiceCard(serviceId) {
                var brandProductHTML = Object.values(selectedData).map(brand => {
                    console.log(brand);
                    var productList = brand.products.map(p => `<span class="badge bg-primary me-1">${p.name}</span>`).join(' ');

                    return `
                <div class="mb-2">
                    <strong>${brand.brandName}:</strong> ${productList || "<span class='text-muted'>No products selected</span>"}
                </div>
            `;
                }).join('');

                $(`#brand-product-list-${serviceId}`).html(brandProductHTML || "-");
            }

            function updateHiddenInputs(serviceId) {
                var selectedBrands = Object.values(selectedData).map(brand => brand.brandId);
                var selectedItems = Object.values(selectedData).flatMap(brand => brand.products.map(p => p.id));

                $(`#brands-ids-${serviceId}`).val(selectedBrands.join(','));
                $(`#items-ids-${serviceId}`).val(selectedItems.join(','));
            }
        });

    </script>
@endpush
--}}

@extends('admin_panel.layout.master')
@section('title')
    Car Form
@endsection

@push('header')
@endpush

@section('style')
    <style>
        .file-input2 {
            display: none !important;
        }
        .cost-box {
            max-width: 500px;
            padding: 20px;
            border: 1px solid #cfd4db;
            border-radius: 8px;
            background-color: #f9fafb;
            font-family: Arial, sans-serif;
            color: #1f2d3d;
        }

        .cost-box h3 {
            margin: 0 0 15px;
            color: #12333f;
        }

        .cost-row,
        .total-row {
            display: flex;
            justify-content: space-between;
            margin: 6px 0;
            font-size: 16px;
        }

        .total-row {
            margin-top: 15px;
            font-weight: bold;
        }

        hr {
            margin: 15px 0;
            border: none;
            border-top: 1px solid #ccc;
        }

        .incl-tax {
            font-weight: normal;
            font-size: 14px;
            margin-left: 5px;
            color: #555;
        }


    </style>
@endsection

@section('content')
    <style>
        .input-service-select {
            appearance: none; /* Remove default browser styles */
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: #f5f5f5; /* Light gray background */
            font-size: 13px;
            font-weight: bold;
            color: #222; /* Dark text */
            padding: 0 16px;
            width: 100%;
            height: 40px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            outline: none;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Soft shadow */
        }

        .input-service-select:focus {
            border: none;
            outline: none;
        }

        .input-service-select::after {
            content: "▼"; /* Custom dropdown arrow */
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 14px;
            pointer-events: none;
        }

        .input-service-select option {
            padding: 12px;
            font-size: 16px;
            background: white;
            color: black;
            font-weight: normal;
        }

        .input-service-select:hover,
        .input-service-select:focus {
            background-color: #e0e0e0;
        }

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
        * {
            padding: 0;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        .wrapper {
            border: 1px solid #4b00ff;
            border-right: 0;
        }
        canvas#signature-pad {
            background: #fff;
            width: 100%;
            height: 100%;
            cursor: crosshair;
        }
        button#clear {
            height: 100%;
            background: #4b00ff;
            border: 1px solid transparent;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
        }
        button#clear span {
            transform: rotate(90deg);
            display: block;
        }

    </style>

    <div class="p-7">
        <div class="container-box-car-form">
            <!-- Client Information -->
            <form class="form" id="myForm"
                  action="{{ route('admin-panel.process-service.save_post' ,object_id($object))}}"
                  enctype="multipart/form-data"
                  method="post">
                @csrf

                <!-- Client Information -->
                <div class="home-subscription d-flex align-items-end">
                    <h5 class="service-h5">{{ __('common.client_info') }}</h5>
                </div>

                <input type="hidden" {{--value="{{object_id($client)}}"--}} name="client_edit">

                <div class="row g-8 p-2">
                    <div class="col-md-6">
                        <input type="text" required class="input-service client-info" value="{{old('name')}}" name="name" placeholder="{{ __('common.first_name') }}">
                    </div>
                    <div class="col-md-6">
                        <input type="text" required  class="input-service client-info" name="last_name" value="{{old('last_name')}}" style="height: 45px" placeholder="{{ __('common.last_name') }}">
                    </div>
                    <div class="col-md-6 position-relative d-flex align-items-center">
                        <input type="text" required class="input-service client-info {{ app()->getLocale() === 'ar' ? 'pe-20' : 'ps-20' }}" name="phone" value="{{old('phone')}}" style="height: 45px;" placeholder="{{ __('common.phone') }}">
                        <span class="phone-code {{ app()->getLocale() === 'ar' ? 'phone-code-right' : 'phone-code-left' }}">+966</span>
                        <span class="confirm-btn {{ app()->getLocale() === 'ar' ? 'me-5 ms-0' : '' }}">{{ __('common.confirm') }}</span>
                    </div>
                    <div class="col-md-6">
                        <input type="email" required class="input-service client-info" name="email" value="{{old('email')}}" style="height: 45px" placeholder="{{ __('common.email') }}">
                    </div>
                </div>

                <!-- Car Information -->
                <div class="home-subscription d-flex align-items-end mt-5">
                    <h5 class="service-h5">{{ __('common.car_info') }}</h5>
                </div>

                <input type="hidden" {{--value="{{object_id($car)}}"--}} name="car_edit">
                <div class="row g-8 p-2">
                    <div class="col-md-6">
                        <label class="fs-6 mb-3">{{ __('common.car_type') }}</label>
                        <input type="text" required class="input-service client-info" value="{{old('type')}}" name="type" placeholder="{{ __('common.car_type') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="fs-6 mb-3">{{ __('common.cate') }}</label>
                        <input type="text" required class="input-service client-info" name="category" value="{{old('category')}}" placeholder="{{ __('common.cate') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="fs-6 mb-3">{{ __('common.color') }}</label>
                        <input type="text" required class="input-service client-info" name="color" value="{{old('color')}}" placeholder="{{ __('common.color') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="fs-6 mb-3">{{ __('common.year_manufacture') }}</label>
                        <input type="text" required class="input-service client-info" name="year_of_manufacture" value="{{old('year_of_manufacture')}}" placeholder="{{ __('common.year_manufacture') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="fs-6 mb-3">{{ __('common.plate_no') }}</label>
                        <div class="plate-number">
                            <div class="plate-number-main">
                                <input type="text" required class="input-service client-info" name="plate_number" value="{{old('plate_number')}}" style="border-radius: 7px"
                                       placeholder="1234">
                            </div>

                            <div class="plate-number-letters">
                                <input name="first_letter" required value="{{old('first_letter')}}" maxlength="1" class="inputs-plate plate-letter" placeholder="A">
                                <input name="second_letter" required value="{{old('second_letter')}}" maxlength="1" class="inputs-plate plate-letter" placeholder="B">
                                <input name="third_letter" required value="{{old('third_letter')}}" maxlength="1" class="inputs-plate plate-letter" placeholder="C">
                            </div>
                        </div>

                    </div>



                    <div class="col-md-6">
                        <label class="fs-6 mb-3">{{ __('common.car_meter_read') }}</label>
                        <div class="plate-number">
                            <div class="plate-number-main">
                                <input type="text" required class="input-service client-info" name="meter_reading" value="{{old('meter_reading')}}" style="border-radius: 7px"
                                       placeholder="24366">
                            </div>

                            <span class="span-km">{{ __('common.km') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Services -->
                <div class="home-subscription d-flex align-items-end mt-5">
                    <h5 class="service-h5">{{ __('common.services') }}</h5>
                </div>

                <div class="row g-3">

                    <div class="col-md-12 mb-4">
                        <select name="company_id"  class="company_id" required>
                            <option value="">Select Company</option>
                            @isset($companies)
                                @foreach($companies as $company)
                                    <option value="{{$company->id}}">{{$company->company_name}}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>

                    <div class="col-md-6 mb-4">
                        <select name="services"  id="addService" class="input-service-select" required>
                            <option value="">Select New Service</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" style="width: 100%" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                Select an option
                            </button>
                            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton" id="addBrands"></ul>
                            <input type="hidden" name="selected_option" id="selectedOption">
                        </div>
                    </div>
                </div>

                <div class="custom-select col-md-12">
                    <div class="select-box" onclick="toggleDropdown()">{{ __('admin.application_area') }} ⬇️</div>
                    <div class="options-container">
                        <label><input type="checkbox" name="application_area[]" value="Full Vehicle"> {{ __('admin.full_vehicle') }} </label>
                        <label><input type="checkbox" name="application_area[]" value="Front Windshield"> {{ __('admin.front_windshield') }} </label>
                        <label><input type="checkbox" name="application_area[]" value="Full Front"> {{ __('admin.full_front') }}</label>
                        <label><input type="checkbox" name="application_area[]" value="Rear Windshield"> {{ __('admin.rear_windshield') }} </label>
                        <label><input type="checkbox" name="application_area[]" value="Front Bumper"> {{ __('admin.front_bumper') }} </label>
                        <label><input type="checkbox" name="application_area[]" value="Sunroof"> {{ __('admin.sunroof') }} </label>
                        <label><input type="checkbox" name="application_area[]" value="Front Fender (R)"> {{ __('admin.front_fender_r') }} </label>
                        <label><input type="checkbox" name="application_area[]" value="Front Window (R)"> {{ __('admin.front_window_r') }} </label>
                        <label><input type="checkbox" name="application_area[]" value="Front Window (L)"> {{ __('admin.front_window_l') }} </label>
                        <label><input type="checkbox" name="application_area[]" value="Front Fender (L)"> {{ __('admin.front_fender_l') }} </label>
                        <label><input type="checkbox" name="application_area[]" value="Full Hood"> {{ __('admin.full_hood') }}</label>
                        <label><input type="checkbox" name="application_area[]" value="Rear Window (R)"> {{ __('admin.rear_window_r') }} </label>
                        <label><input type="checkbox" name="application_area[]" value="Rear Window (L)"> {{ __('admin.rear_window_l') }} </label>
                        <label><input type="checkbox" name="application_area[]" value="Front Door (R)"> {{ __('admin.front_door_r') }} </label>
                        <label><input type="checkbox" name="application_area[]" value="Front Door (L)"> {{ __('admin.front_door_l') }} </label>
                        <label><input type="checkbox" name="application_area[]" value="Roof Top"> {{ __('admin.roof_top') }} </label>
                        <label><input type="checkbox" name="application_area[]" value="Mpv - Rear Fix Window (R)"> {{ __('admin.rear_fix_r') }} </label>
                        <label><input type="checkbox" name="application_area[]" value="Mpv - Rear Fix Window (L)"> {{ __('admin.rear_fix_l') }} </label>
                    </div>
                </div>

                <div class="new-service d-none brand-items-added p-5">
                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="col-8 project-card-special p-7">
                            <div class="brand-selected flex-between">
                                <h5 class="fw-bold brand-name"></h5>

                                <div class="delete-icon delete-icon-brand">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M6 6L18 18M6 18L18 6" stroke="currentColor" stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>

                            <div class="d-none item-selected flex-between">
                                <p class="item-name"></p>

                                <div class="delete-icon delete-icon-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M6 6L18 18M6 18L18 6" stroke="currentColor" stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <input type="number" class="input-service client-info input-price" name="cost[]"  placeholder="{{ __('common.price_tax') }}" required disabled>
                            <input type="text" class="input-service client-info my-3" name="serial_number[]"  placeholder="{{ __('common.serial_no') }}" disabled>
                            <input type="text" class="input-service client-info" name="warranty_code[]"  placeholder="{{ __('common.warranty_code') }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="p-5">
                    <div class="d-none project-card p-7" id="selected-app-area"></div>
                </div>

                <div id="vehicle-container"></div>

                {{-- branch --}}
                <div class="home-subscription d-flex align-items-end mt-5">
                    <h5 class="service-h5">{{ __('common.branches') }}</h5>
                </div>

                <div class="col-md-12">
                    <select class="form-select branch-select-company" required name="center_id" id="branch-select">
                        <option value="">Select Branch</option>
                    </select>
                </div>

                {{-- administrator --}}
                <div class="home-subscription d-flex align-items-end mt-5">
                    <h5 class="service-h5">{{ __('common.administrator') }}</h5>
                </div>

                <div class="col-md-12">
                    <select class="form-select administrator-select" required name="administrator" id="admin-select">
                        <option value="">Select Administrator</option>
                    </select>
                </div>

                {{--upload images--}}
                <div class="home-subscription d-flex align-items-end mt-5">
                    <h5 class="service-h5">{{ __('common.car_images') }}</h5>
                </div>

                <div class="text-center my-12">
                    <p class="fs-4">{{ __('common.take_car_images') }}</p>
                    <div class="d-flex justify-content-center align-items-center">
                        <input type="file" name="images[]" class="file-input2" style="display:none;" id="fileInput" multiple>
                        <img src="{{ asset('assets/icons/attach-file-icon.svg') }}" width="65" height="65" id="uploadTrigger">
                    </div>
                </div>

                <div class="image-container d-flex flex-wrap"></div>

                <div class="under-process-div mb-12" style="background-color: #F9FAFB">
                    <h4 style="color: #1C4853">{{ __('common.customer_signature') }}</h4>
                </div>

                <div class="px-8 click-signature" style="margin-bottom: 90px">
                    <a  class="link-box px-8">
                        {{ __('common.click_customer_signature') }}
                    </a>
                </div>

                <div class="signature-show d-none">
                    <div class="wrapper">
                        <canvas id="signature-pad" width="400" height="200"></canvas>
                    </div>

                    <input type="hidden" name="signature" id="signature-data" required>

                    <div class="clear-btn">
                        <button id="clear" type="button"><span> Clear </span></button>
                    </div>
                </div>

                <div class="calc-cost d-none card p-8 mb-10">
                    <h2 class="fw-bold py-3" style="color: #1C4853">{{ __('common.cost') }}</h2>
                    <div class="services-price d-none d-flex justify-content-between">
                        <div class="">
                            <p class="service-name"></p>
                        </div>

                        <div class="pe-18">
                            <p class="fw-bold fs-7 service-price"></p>
                        </div>
                    </div>
                    <hr>

                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h3 style="color: #1C4853">{{ __('common.total_cost') }}</h3>
                        </div>

                        <div class="pe-2">
                            <p><span class="fw-bold fs-7 me-2 total-price"></span> {{ __('common.price_tax') }}</p>
                        </div>
                    </div>
                </div>

                <div class="modal-footer flex-center pt-8">
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">{{ __('common.submit') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
@push('footer')
    <script src="{{url('design/admin')}}/assets/js/signature_pad.min.js"></script>

    <script>

        /*start get data by company*/
        $('.company_id').on('change', function () {
            const company_id = $(this).val();

            $.ajax({
                url: "{{ route('get-administrators') }}",
                type: "GET",
                data: { company_id: company_id },
                success: function(response) {
                    // --- Administrators ---
                    const $adminSelect = $('.administrator-select');
                    $adminSelect.empty();
                    $adminSelect.append('<option value="">Select Administrator</option>');

                    response.administrators.forEach(function(admin) {
                        $adminSelect.append(`<option value="${admin.id}">${admin.administrator_name}</option>`);
                    });

                    // --- Branches ---
                    const $branchSelect = $('.branch-select-company');
                    $branchSelect.empty();
                    $branchSelect.append('<option value="">Select Branch</option>');

                    response.branches.forEach(function(branch) {
                        $branchSelect.append(`<option value="${branch.id}">${branch.branch_name}</option>`);
                    });

                    // --- services ---
                    const $serviceSelect = $('.input-service-select');
                    $serviceSelect.empty();
                    $serviceSelect.append('<option value="">Select Branch</option>');
                    response.services_company.forEach(function(service) {
                         $serviceSelect.append(`<option value="${service.id}">${service.service_name}</option>`);
                    });
                }
            });
        });

        /*end get data by company*/


        /*start signature*/

        let signaturePad;
        let canvas;

        $('.click-signature').click(function () {
            $('.signature-show').removeClass('d-none');

            // Wait for DOM update/rendering
            setTimeout(function () {
                canvas = document.getElementById("signature-pad");

                function resizeCanvas() {
                    const ratio = Math.max(window.devicePixelRatio || 1, 1);
                    canvas.width = canvas.offsetWidth * ratio;
                    canvas.height = canvas.offsetHeight * ratio;
                    canvas.getContext("2d").scale(ratio, ratio);
                }

                resizeCanvas(); // resize after showing
                window.onresize = resizeCanvas;

                signaturePad = new SignaturePad(canvas, {
                    backgroundColor: 'rgb(250,250,250)'
                });
            }, 100); // small delay to allow rendering
        });

        // Clear button
        document.getElementById("clear").addEventListener('click', function () {
            if (signaturePad) signaturePad.clear();
        });

        // Form submit
        document.getElementById("myForm").addEventListener('submit', function (e) {
            if (signaturePad && !signaturePad.isEmpty()) {
                const dataUrl = canvas.toDataURL('image/png');
                document.getElementById('signature-data').value = dataUrl;
            } else {
                alert("Please provide a signature before submitting.");
                e.preventDefault();
            }
        });

        /*end signature*/


        $(document).ready(function () {
            // Handle file input change
            $('#fileInput').on('change', function () {
                const files = this.files;
                const maxFiles = 4;

                if (files.length > maxFiles) {
                    alert(`You can only upload up to ${maxFiles} images.`);
                    $('#fileInput').val(''); // clear input
                    return;
                }

                if (files.length <= maxFiles) {
                    $('.image-container').removeClass('d-none');

                    for (let i = 0; i < files.length; i++) {
                        const reader = new FileReader();

                        reader.onload = function (e) {
                            const imgHtml = `
                            <div class="image-item position-relative me-2 mb-2">
                                <img src="${e.target.result}" alt="Selected Image" width="100" height="100" style="height: 200px ; width: 200px" class="img-thumbnail" />
                                </div>
                        `;
                            $('.image-container').append(imgHtml);
                        };

                        reader.readAsDataURL(files[i]);
                    }
                }
            });
        });

        //new code jquery
        $(document).on('click', '#addBrands .dropdown-item', function (e) {
            e.preventDefault();
            let selectedText = $(this).text();
            let selectedValue = $(this).attr('data-value');

            $('#dropdownMenuButton').text(selectedText);
            $('#selectedOption').val(selectedValue);
        });
        //select items after select service

        $('#addService').change(function() {
            var serviceId = $(this).val();
            // console.log(serviceId)
            if (serviceId) {
                $.ajax({
                    url: "{{ route('admin-panel.process-service.get_brands') }}",
                    type: "GET",
                    data: { service_id: serviceId },
                    success: function(response) {
                        console.log(response)
                        $('#addBrands').empty();
                        $('#addBrands').append('<li><a class="dropdown-item" href="#" data-value="new add">Select Brands</a></li>');
                        $.each(response, function(index, brand) {
                            if (brand.id) {
                                let brandItem = $('<li><a class="dropdown-item brand-item" style="color: red" href="#" data-brand-id="'+ brand.id +'" data-brand-name="'+ brand.brand_name +'">'+ brand.brand_name +'</a></li>');
                                $('#addBrands').append(brandItem);

                                if (brand.item_names && brand.item_ids) {
                                    let itemNames = brand.item_names.split(', ');
                                    let itemIds = brand.item_ids.split(', ');

                                    $.each(itemNames, function(itemIndex, itemName) {
                                        let itemId = itemIds[itemIndex];
                                        let productItem = $('<li><a class="dropdown-item product-item" href="#" data-product-id="'+ itemId +'" data-product-name="'+ itemName +'" data-brand-id="'+ brand.id +'" data-brand-name="'+ brand.brand_name +'">'+ itemName +' </a></li>');
                                        $('#addBrands').append(productItem);
                                    });
                                }
                            }
                        });
                    }
                });
            } else {
                $('#addBrands').empty();
                $('#addBrands').append('<li><a class="dropdown-item" href="#" data-value="new add">Select Brands</a></li>');
            }
            handleBrandSelection()
        });

        function addBrand(service_name , service_id , brand_id = -1 , brand_name = "", item_id = -1, item_name = "") {
            if (!service_name.trim()) return;

            let existingService = $(".brand-items-added:not(.d-none)").last();
            let clone;

            if (!existingService.length || item_id === -1) {
                clone = $(".brand-items-added").first().clone().removeClass("d-none");

                clone.find(".brand-name").text(service_name);
                clone.append(`<input type="hidden" name="service_id[]" value="${service_id}">`);
                /*clone.find(".input-price").removeAttr('disabled')
                clone.find(".input-serial").removeAttr('disabled')
                clone.find(".input-warranty").removeAttr('disabled')*/
                clone.find(".input-service").removeAttr('disabled')

                $(".brand-items-added").last().after(clone);
                $(".cost-box").removeClass("d-none")
            } else {
                clone = existingService;
            }

            if (brand_id !== -1) {

                let brandInput = clone.find("input[name='brand_ids[]']");

                if (brandInput.length) {
                    let existingBrands = brandInput.val() ? brandInput.val().split("&&") : [];

                    // Check if the brand_id already exists
                    if (!existingBrands.includes(brand_id.toString())) {
                        existingBrands.push(brand_id);
                        brandInput.val(existingBrands.join("&&"));
                    }
                } else {
                    // If input does not exist, create it
                    clone.append(`<input type="hidden" name="brand_ids[]" value="${brand_id}">`);
                }
            }

            if (item_id !== -1) {
                let cloneItem = $(".item-selected").first().clone().removeClass("d-none");
                cloneItem.find(".item-name").text(item_name);
                $(".item-selected").last().after(cloneItem);

                let itemsInput = clone.find("input[name='item_ids[]']");
                if (itemsInput.length) {
                    let existingItems = itemsInput.val();
                    itemsInput.val(existingItems ? existingItems + "&&" + item_id : item_id);
                } else {
                    clone.append(`<input type="hidden" name="item_ids[]" value="${item_id}">`);
                }
            }

            $(".brand-items-added").last().after(clone);
            clone.find(".delete-icon-item").click(function () {
                let itemElement = $(this).closest(".item-selected");
                let itemId = itemElement.find("input[name='item_ids[]']").val();
                let itemsInput = clone.find("input[name='item_ids[]']");

                // Remove item from the hidden input value
                let updatedItems = itemsInput.val().split("&&").filter(id => id !== itemId).join("&&");
                itemsInput.val(updatedItems);

                itemElement.remove();
            });

            clone.find(".delete-icon-brand").click(function () {
                clone.remove();
            });

            clone.find(".delete-btn").click(function () {
                clone.remove();
            });

        }

        function handleBrandSelection() {
            let selectedBrandId = $("#addService").val();
            let selectedBrand = $("#addService option:selected").text();
            addBrand(selectedBrand , selectedBrandId);
        }

        $(document).on("click", ".product-item", function(e) {
            e.preventDefault();
            let productId = $(this).data("product-id");
            let productName = $(this).data("product-name");
            let brandId = $(this).data("brand-id");
            let brandName = $(this).data("brand-name");
            let lastService = $(".brand-items-added:not(.d-none)").last();

            if (!lastService.length || lastService.hasClass("d-none")) {
                alert("Select a brand first.");
                return;
            }
            addBrand(lastService.find(".brand-name").text(),lastService.find("input[name='service_id[]']").val(),brandId, brandName ,productId, productName)

            let formattedData = collectData(); // Collect structured data

            console.log("Formatted Data:", formattedData);
        });

        function collectData() {
            let data = [];

            $(".brand-items-added:not(.d-none)").each(function () {
                let service_id = $(this).find("input[name='service_id[]']").val();
                let brand_ids = $(this).find("input[name='brand_ids[]']").val();
                let item_ids = $(this).find("input[name='item_ids[]']").val();

                if (!service_id || !brand_ids) return;

                let itemList = item_ids ? item_ids.split("&&") : [];
                let brandList = brand_ids ? brand_ids.split("&&") : [];

                let existingService = data.find(service => service.service_id === service_id);

                if (!existingService) {
                    existingService = {
                        service_id: service_id,
                        brands: []
                    };
                    data.push(existingService);
                }

                brandList.forEach(brand_id => {
                    let existingBrand = existingService.brands.find(brand => brand.brand_id === brand_id);

                    if (existingBrand) {
                        // Append new items to existing brand (avoid duplicates)
                        existingBrand.items = [...new Set([...existingBrand.items, ...itemList])];
                    } else {
                        // Add new brand with its items
                        existingService.brands.push({
                            brand_id: brand_id,
                            items: itemList
                        });
                    }
                });
            });

            return data;
        }

        function generateInputsFromData(data) {
            $("#generated-inputs").remove();
            let container = $('<div id="generated-inputs" style="display: none;"></div>');

            data.forEach((service, sIndex) => {
                container.append(`<input type="hidden" name="services[${sIndex}][service_id]" value="${service.service_id}">`);

                service.brands.forEach((brand, bIndex) => {
                    container.append(`<input type="hidden" name="services[${sIndex}][brands][${bIndex}][brand_id]" value="${brand.brand_id}">`);

                    brand.items.forEach((item, iIndex) => {
                        container.append(`<input type="hidden" name="services[${sIndex}][brands][${bIndex}][items][]" value="${item}">`);
                    });
                });
            });

            $("form").append(container);
        }

        $("#myForm").submit(function (e) {
            let formattedData = collectData();
            generateInputsFromData(formattedData);
        });


        function toggleDropdown() {
            document.querySelector('.custom-select').classList.toggle('active');
        }

        document.addEventListener('click', function (event) {
            const select = document.querySelector('.custom-select');
            if (!select.contains(event.target)) {
                select.classList.remove('active');
            }
        });



        const uploadTrigger = document.getElementById("uploadTrigger");
        const fileInput = document.getElementById("fileInput");
        uploadTrigger.addEventListener("click", function() {
            fileInput.click();
        });

        $(document).on('change', '.input-price', function (e) {
            let priceVal        = parseFloat($(this).val()) || 0;
            let parentEle       = $(this).closest(".new-service");
            let serviceName     = parentEle.find('.brand-name').text();

            $('.calc-cost').removeClass("d-none");

            let clone = $(".services-price").first().clone().removeClass("d-none");
            clone.find(".service-name").text(serviceName);
            clone.find(".service-price").text(priceVal + 'SR'); // priceVal + SR
            $(".services-price").last().after(clone);

            let total = 0;
            $('.service-price').each(function () {
                let val = parseFloat($(this).text()) || 0;
                total += val;
            });

            $('.total-price').text(total.toFixed(2) + 'SR');
        });

        $(document).ready(function () {
            function makeSafeId(value) {
                return value.replace(/\s+/g, '-').replace(/[()]/g, '').toLowerCase();
            }

            $('input[name="application_area[]"][value="Full Vehicle"]').change(function () {
                $('#selected-app-area').removeClass('d-none');
                if ($(this).is(':checked')) {
                    // Disable and uncheck all other checkboxes
                    $('input[name="application_area[]"]').not(this).prop('disabled', true).prop('checked', false);

                    // Remove all other selected elements except Full Vehicle
                    $('#selected-app-area').children('p').not('#app-area-full-vehicle').remove();

                    // Add Full Vehicle to selected list if not already there
                    if ($('#app-area-full-vehicle').length === 0) {
                        $('#selected-app-area').append('<p id="app-area-full-vehicle">Full Vehicle</p>');
                    }
                } else {
                    $('input[name="application_area[]"]').prop('disabled', false);
                    $('#app-area-full-vehicle').remove(); // Remove Full Vehicle from selected list
                }
            });

            $('input[name="application_area[]"]').click(function () {
                const value = $(this).val();
                const id = makeSafeId(value);

                $('#selected-app-area').removeClass('d-none');
                if ($(this).is(':checked')) {
                    if ($(`#app-area-${id}`).length === 0) {
                        $('#selected-app-area').append(`<p id="app-area-${id}">${value}</p>`);
                    }
                } else {
                    $(`#app-area-${id}`).remove();
                }
            });

        });
    </script>
@endpush
