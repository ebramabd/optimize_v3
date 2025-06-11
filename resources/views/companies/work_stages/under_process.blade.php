@extends('admin_panel.layout.master')

@section('title')
    {{ __('common.work_stages') }}
@endsection

@push('header')
@endpush

@section('content')
    <style>
        .input-service-select {
            appearance: none; /* Remove default browser styles */
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: #f5f5f5; /* Light gray background */
            font-size: 16px;
            font-weight: bold;
            color: #222; /* Dark text */
            padding: 12px 16px;
            width: 100%;
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

        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap');
        * {
            padding: 0;
            margin: 0;
            font-family: "Tajawal", sans-serif !important;
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
    <!-- Main Content -->
    <div class="p-7">
        <h1 class="home-h1">{{ __('common.work_stages') }} / {{ __('common.pending') }}</h1>

        <div class="under-process-div" style="background-color: #F9F7E8">
            <h5>{{ __('common.under_process') }}</h5>
        </div>

        <div class="d-none" id="DivIdToPrint">
            <div class="print-version" style="">
                <div class="print-container">
                    <div class="img-logo-profile">
                        @isset($company)
                            <img src="{{ asset('storage/' . $company->profile_picture) }}" alt="Company Logo">
                        @endisset
                    </div>

                    <h2 class="text-center" style="font-size:10px;font-weight:normal;">اتفاقية تقديم الخدمات</h2>
                    <h2 class="text-center" style="font-size:20px;margin-top:10px;margin-bottom:20px">SERVICE AGREEMENT</h2>

                    <div class="print-section">
                        <div class="print-row">
                            <div class="print-field">
                                <div>
                                    <label style="font-weight: normal; font-size: 10px">مالك المركبة</label>
                                    <label>Owner</label>
                                </div>

                                <div class="field-value">{{ $client->name ?? '' }}</div>
                            </div>

                            <div class="print-field">
                                <div>
                                    <label style="font-weight: normal; font-size: 10px">البريد</label>
                                    <label>Email</label>
                                </div>

                                <div class="field-value">{{ $client->email ?? '' }}</div>
                            </div>

                            <div class="print-field">
                                <div>
                                    <label style="font-weight: normal; font-size: 10px">رقم الجوال</label>
                                    <label>Mobile Number</label>
                                </div>

                                <div class="field-value">{{ $client->phone ?? '' }}</div>
                            </div>
                        </div>

                        <div class="print-row">
                            <div class="print-field">
                                <div>
                                    <label style="font-weight: normal; font-size: 10px">نوع لمركبة</label>
                                    <label>Car Type</label>
                                </div>

                                <div class="field-value">{{ $car->type ?? '' }}</div>
                            </div>

                            <div class="print-field">
                                <div>
                                    <label style="font-weight: normal; font-size: 10px">الموديل</label>
                                    <label>Category</label>
                                </div>

                                <div class="field-value">{{ $car->category ?? '' }}</div>
                            </div>

                            <div class="print-field">
                                <div>
                                    <label style="font-weight: normal; font-size: 10px">سنة الصنع</label>
                                    <label>Year Of Manufacture</label>
                                </div>

                                <div class="field-value">{{ $car->year_of_manufacture ?? '' }}</div>
                            </div>
                        </div>

                        <div class="print-row">
                            <div class="print-field">
                                <div>
                                    <label style="font-weight: normal; font-size: 10px">رقم اللوحة</label>
                                    <label>Plate Number</label>
                                </div>

                                <div class="field-value">{{ $car->plate_number }} {{ $car->first_letter }} {{ $car->second_letter }} {{ $car->third_letter }}</div>
                            </div>

                            <div class="print-field">
                                <div>
                                    <label style="font-weight: normal; font-size: 10px">قراءة العداد</label>
                                    <label>Car Meter Reading</label>
                                </div>

                                <div class="field-value">{{ $car->meter_reading ?? '' }}</div>
                            </div>

                            <div class="print-field">
                                <div>
                                    <label style="font-weight: normal; font-size: 10px">الفرع</label>
                                    <label>Branch</label>
                                </div>

                                <div class="field-value">{{ $branch_name->branch_name ?? '' }}</div>
                            </div>
                        </div>

                        <div class="print-row">
                            <div class="print-field">
                                <div>
                                    <label style="font-weight: normal; font-size: 10px">المسؤل</label>
                                    <label>Administrator</label>
                                </div>

                                <div class="field-value">{{ $administrator->administrator_name ?? '' }}</div>
                            </div>

                            <div class="print-field">
                                <div>
                                    <label style="font-weight: normal; font-size: 10px">تاريخ الدخول</label>
                                    <label>Check In Date</label>
                                </div>

                                <div class="field-value">{{ \Carbon\Carbon::parse($created_at)->format('j-n-Y') ?? '' }}</div>
                            </div>

                            <div class="print-field">
                                <div>
                                    <label style="font-weight: normal; font-size: 10px">رقم اطلب</label>
                                    <label>Order Id</label>
                                </div>

                                <div class="field-value">{{ $orderID ?? '' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="all-services">
                        <div class="text-header" style="display:flex;justify-content: space-between">
                            <div>
                                <h2 style="color:white;font-size: 15px">الخدمات / Services</h2>
                            </div>

                            <div>
                                <h2 style="color:white;font-size: 15px">التكلفة / Cost</h2>
                            </div>
                        </div>

                        @isset($services)
                            @foreach($services as $service)
                                <div class="services-info flex justify-content-between" style="display:flex;justify-content: space-between">
                                    <div style="padding: 0 ;width:80%;margin: 0">
                                        <div style="padding: 0;margin: 0">
                                            <h6 style="padding: 5px 0; margin: 0;font-size: 10px;font-weight: bold">
                                                {{\App\Models\Service::where('id', $service['service_id'])->first()->service_name}}
                                            </h6>
                                            @isset($service['brands'])
                                                @foreach($service['brands'] as $brands)
                                                    @foreach($brands['items'] as $items)
                                                        <span style="padding:  0; margin:0; font-size: 10px"> {{\App\Models\Item::where('id', $items)->first()->item_name ?? ''}} /</span>
                                                    @endforeach
                                                @endforeach
                                            @endisset

                                            @php
                                                $areas = \App\Models\OrderCosting::where(['process_id'=>$service['process_id'] , 'service_id'=>$service['service_id']])->first()->app_area ?? '';
                                            @endphp
                                            <p class="p-print" style="font-size: 8px">
                                                {{$areas}}
                                            </p>

                                        </div>
                                    </div>

                                    @php
                                        $costing = \App\Models\OrderCosting::where(['process_id'=>$service['process_id'] , 'service_id'=>$service['service_id']])->first();
                                    @endphp

                                    <div class="" style="width: 55%;">
                                        <div style="padding: 0 100px;font-size: 20px;">
                                            @isset($costing->cost)
                                                <span class="">{{$costing->cost}}</span>
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endisset


                        @isset($costingService)
                            <div class="services-info flex justify-content-between" style="display:flex;justify-content: space-between">
                                <div style="padding: 0 ;width:80%;margin: 0">
                                    <div style="padding: 0;margin: 0">
                                        <h6 style="padding: 5px 0; margin: 0;font-size: 10px;font-weight: bold">
                                            total
                                        </h6>
                                    </div>
                                </div>

                                <div class="" style="width: 55%;">
                                    <div style="padding: 0 100px;font-size: 20px;">
                                        @php
                                            $totalCost = collect($costingService)->pluck('cost')->sum();
                                        @endphp
                                        <span class="">{{$totalCost}}</span>
                                    </div>
                                </div>
                            </div>
                        @endisset

                    </div>

                    <div class="car-images print-page-break">
                        @isset($images)
                            <div class="image-container d-flex flex-wrap">
                                @foreach($images as $image)
                                    @if($image->order_status==0)
                                        <div class="image-item position-relative me-2 mb-2" id="image-{{$image->id}}">
                                            <img src="{{ asset('storage/' . $image->image) }}" alt="Car Image" class="img-thumbnail" style="width: 300px; height: 300px;">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endisset
                    </div>

                    <div class="print-section print-terms">
                        <div class="text-header-terms" style="display:flex;justify-content: space-between">
                            <div>
                                <h2 style="color:white;font-size: 15px">Conditions & Terms</h2>
                            </div>

                            <div>
                                <h2 style="color:white;font-size: 15px">الاحكام والشروط</h2>
                            </div>
                        </div>

                        <div style="display: flex; justify-content: space-between; gap: 20px;">
                            <!-- English Terms (Left) -->
                            <div class="terms-en text-start" style="width: 50%; padding: 25px 0;">
                                <p><strong>Collect Information</strong></p>

                                @isset($terms_en)
                                    <ol>
                                        @foreach(explode("\n", $terms_en) as $item)
                                            @if(trim($item) !== '')
                                                <li style='font-size:12px'>{{ $item }}</li>
                                            @endif
                                        @endforeach
                                    </ol>
                                @endisset
                            </div>

                            <!-- Arabic Terms (Right) -->
                            <div class="terms-ar text-end" dir="rtl" style="width: 50%; padding: 25px 0;">
                                <p><strong>جمع المعلومات</strong></p>

                                @isset($terms_ar)
                                    <ol>
                                        @foreach(explode("\n", $terms_ar) as $item)
                                            @if(trim($item) !== '')
                                                <li style='font-size:12px'>{{ $item }}</li>
                                            @endif
                                        @endforeach
                                    </ol>
                                @endisset
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!--begin::Footer-->

            <img  style='display:none' src="{{ $footer_image ? asset('storage/' . $footer_image) : asset('assets/imgs/footer_main.png') }}">


            <style>
                @page {

                    margin-bottom: 200px;
                    counter-increment: page;
                    border-bottom: 1px solid #000000;

                    @bottom-left {
                        padding-top: 60px;
                        padding-left:80px;
                        content:  url("{{ $footer_image ? asset('storage/' . $footer_image) : asset('assets/imgs/footer_main.png') }}");
                        width:500px;
                        height: 100px;
                    }

                }
            </style>

            <style>
                @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap');
                /*#DivIdToPrint {*/
                /*    font-size: 8px;*/
                /*}*/

                .p-print{
                    margin-top: 0 !important;
                    font-family: "Tajawal", sans-serif !important;
                }
                .text-header h2 {
                    margin: 0;
                    padding: 0;
                    font-family: "Tajawal", sans-serif !important;
                }

                .image-container {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 16px; /* Optional: adds space between images */
                    font-family: "Tajawal", sans-serif !important;
                }

                .image-item {
                    width: calc(50% - 8px); /* Two items per row, accounting for gap */
                    box-sizing: border-box;
                }

                .image-item img {
                    width: 100%;
                    height: 240px;
                    object-fit: cover;
                }

                body, .print-container {
                    padding-bottom: 150px;
                    font-family: "Tajawal", sans-serif !important;
                }

                .text-center {
                    text-align: center;
                }

                .text-start {
                    text-align: start;
                }

                .text-end {
                    text-align: end;
                }

                .img-logo img {
                    width: 370px;
                    height: 90px;
                }

                .print-terms {
                    font-size: 12px;
                    margin-top: 30px;
                }

                .text-header {
                    background-color: #060664;
                    color: white;
                    padding: 0 100px;
                }

                .text-header-terms {
                    background-color: #060664;
                    color: white;
                    padding: 0 100px;
                }

                .print-only-footer {
                    /*position: absolute;*/
                    bottom: 0;
                    width: 100%;
                    display: block;
                }

                .start-footer {
                    border-top: 2px solid black;
                }

                .print-container {
                    width: 100%;
                    padding: 20px;
                    box-sizing: border-box;
                    background: white;
                    color: black;
                }

                .img-logo-profile {
                    background-color: #1a1a1a;
                    position: absolute;
                    right: 70px;
                    transform: translateY(-15px);
                }

                .img-logo-profile img {
                    width: 180px;
                    height: 80px;
                }

                .print-section {
                    margin: 10px 0;
                    border-bottom: 4px solid rgba(27, 27, 112, 0.95);
                    border-top: 4px solid rgba(27, 27, 112, 0.95);
                }

                .print-row {
                    display: flex;
                    justify-content: space-between;
                    flex-wrap: wrap;
                    border-bottom: 1px solid #000;
                    padding: 5px 10px;
                }

                .print-row:last-child {
                    border-bottom: none;
                }

                .services-info {
                    display: flex;
                    justify-content: space-between;
                    align-items: center; /* optional: center vertically */
                    /*gap: 10px; !*  Add this! Adjust as you like: 20px, 30px, 40px *!*/

                    height: 100px;
                    margin: 0;
                    padding: 0;
                    border-bottom: 1px solid #cccccc;
                    /*margin-bottom: 5px;*/
                    /*margin-top: 5px;*/
                    page-break-inside: avoid;
                }




                .services-info:last-child {
                    border-bottom: none;
                }

                .print-field {
                    flex: 0 0 33%;
                    padding: 4px 0;
                    display: flex;
                    align-items: baseline;
                    gap: 20px;
                }

                .print-field > div:first-child {
                    width: 80px; /* Fixed width for label part */
                }

                .field-value {
                    flex-grow: 1; /* Value will expand nicely */
                    font-weight: bold;
                    margin-left: 0; /* remove your old margin-left */
                }

                .print-field label {
                    font-weight: bold;
                    display: block;
                    margin-bottom: 2px;
                }

                .print-table th, .print-table td {
                    border: 1px solid #000;
                    padding: 8px;
                    text-align: center;
                }

                .print-only {
                    display: none;
                }

                @media print {
                    .print-page-break {
                        page-break-before: always;
                    }

                    .print-section
                    {
                        page-break-inside: avoid;
                    }

                    .all-services {
                        /* No page-break-before here */
                        /* No break-inside here */
                    }

                    .services-info {
                        break-inside: avoid;
                        page-break-inside: avoid;
                    }

                    .print-terms {
                        page-break-before: always;
                    }

                    .print-only {
                        display: block;
                    }

                    .print-only-footer {
                        /*position: absolute;*/
                        bottom: 0;
                        width: 100%;
                        background: black;
                        text-align: center;
                        padding: 10px;
                        font-size: 12px;
                    }

                    .text-header, .text-header-terms {
                        background-color: #060664 !important;
                        -webkit-print-color-adjust: exact;
                        print-color-adjust: exact;
                    }

                    .text-header h2 {
                        font-size: 15px;
                        margin: 0;
                        padding: 13px;
                    }

                    .services-info {
                        /*height: 100px;*/
                        margin: 0;
                        padding: 0;
                    }
                }

                .terms-en {
                    border-right: 1px solid #060664;
                    margin-right: 0px;
                    margin-left: 0px;
                }

                .text-end ol {
                    direction: rtl;
                    list-style-position: inside;
                }
            </style>
        </div>

        <form class="form" id="myForm"
              action="{{ route('companies.work_stages.edit_order' , $id)}}"
              enctype="multipart/form-data"
              method="post">
            @csrf
            <div style='font-family: "Tajawal", sans-serif !important;display: flex;'>
                <a href="{{route('send.service.agreement', $id)}}" class="btn-work-done">Send Form Agreement </a>
            </div>
            <div class="work-stages-edit edit-disable">
                <button class="work-stages-btn-edit">
                    <i class='far fa-edit' style='font-size:20px'></i>
                    {{ __('common.edit') }}
                </button>
            </div>

            <div class="work-stages-edit edit-submit d-none">
                <button type="submit" class="work-stages-btn-edit">
                    {{ __('common.save') }}
                </button>
            </div>
            <div class="card p-8 mb-10">
                <h2 class="fw-bold py-3" style="color: #1C4853">{{ __('common.client_info') }}</h2>

                <div class="row g-8 p-2 {{ app()->getLocale() === 'ar' ? 'ps-18' : 'pe-18' }}">
                    <div class="col-md-6">
                        <input type="text" value="{{$client->name}}" name="name" class="input-service client-info" placeholder="{{ __('common.first_name') }}">
                    </div>
                    <div class="col-md-6">
                        <input type="text" value="{{$client->last_name}}" name="last_name" class="input-service client-info" style="height: 45px" placeholder="{{ __('common.last_name') }}">
                    </div>
                    <div class="col-md-6 position-relative d-flex align-items-center">
                        <input type="text" value="{{$client->phone}}" name="phone" class="input-service client-info {{ app()->getLocale() === 'ar' ? 'pe-20' : 'ps-20' }}" style="height: 45px;" placeholder="{{ __('common.phone') }}">
                        <span class="phone-code {{ app()->getLocale() === 'ar' ? 'phone-code-right' : 'phone-code-left' }}">+966</span>
                    </div>
                    <div class="col-md-6">
                        <input type="email" value="{{$client->email}}" name="email" class="input-service client-info" style="height: 45px" placeholder="{{ __('common.email') }}">
                    </div>
                </div>
            </div>

            <div class="card p-8 mb-10">
                <h2 class="fw-bold py-3" style="color: #1C4853">{{ __('common.car_info') }}</h2>

                <div class="row g-8 p-2 {{ app()->getLocale() === 'ar' ? 'ps-18' : 'pe-18' }}">
                    <div class="col-md-6">
                        <label class="fs-6 mb-3">{{ __('common.car_type') }}</label>
                        <input type="text" value="{{$car->type}}" name="type" class="input-service client-info"
                               placeholder="{{ __('common.car_type') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="fs-6 mb-3">{{ __('common.cate') }}</label>
                        <input type="text" value="{{$car->category}}" name="category" class="input-service client-info"
                               placeholder="{{ __('common.cate') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="fs-6 mb-3">{{ __('common.color') }}</label>
                        <input type="text" value="{{$car->color}}" name="color" class="input-service client-info"
                               placeholder="{{ __('common.color') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="fs-6 mb-3">{{ __('common.year_manufacture') }}</label>
                        <input type="text" value="{{$car->year_of_manufacture}}" name="year_of_manufacture"
                               class="input-service client-info" placeholder="{{ __('common.year_manufacture') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="fs-6 mb-3">{{ __('common.plate_no') }}</label>
                        <div class="plate-number">
                            <div class="plate-number-main">
                                <input value="{{$car->plate_number}}" name="plate_number" type="text"
                                       class="input-service client-info" style="border-radius: 7px"
                                       placeholder="1234">
                            </div>

                            <div class="plate-number-letters">
                                <input name="first_letter" value="{{$car->first_letter}}"   maxlength="1" class="inputs-plate plate-letter" placeholder="A">
                                <input name="second_letter" value="{{$car->second_letter}}" maxlength="1" class="inputs-plate plate-letter" placeholder="B">
                                <input name="third_letter"  value="{{$car->third_letter}}" maxlength="1" class="inputs-plate plate-letter" placeholder="C">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="fs-6 mb-3">{{ __('common.car_meter_read') }}</label>
                        <div class="plate-number">
                            <div class="plate-number-main">
                                <input value="{{$car->meter_reading}}" name="meter_reading" type="text"
                                       class="input-service client-info" style="border-radius: 7px"
                                       placeholder="24366">
                            </div>

                            <span class="span-km">{{ __('common.km') }}</span>
                        </div>
                    </div>
                </div>
            </div>


            {{--add new service--}}
            <div class="card p-8 mb-10">
                <h2 class="fw-bold py-3" style="color: #1C4853">Add new service </h2>

                <div class="row g-8 p-2 pe-18">
                    <div class="col-md-6">
                        <select name="services" id="addService" class="input-service-select disabled">
                            <option value="">Select New Service </option>
                            @isset($selectServices)
                                @foreach($selectServices as $service)
                                    <option value="{{$service->id}}">{{$service->service_name}}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>

                    <div class="col-md-6">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" style="width: 100%" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                Select an option
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="addBrands"></ul>
                            <input type="hidden" name="selected_option" id="selectedOption">
                        </div>
                    </div>
                </div>

                <div class="custom-select p-2 pe-18 col-md-12 disabled">
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

                                <div class="d-none area-selected flex-between">
                                    <p class="area-name"></p>

                                    <input type="hidden" name="app_area[]" class="hidden-app-area" disabled>
                                </div>
                            </div>

                            <div class="col-3">
                                <input type="number" class="input-service client-info input-price" name="cost[]" placeholder="{{ __('common.price_tax') }}" required disabled>
                                <input type="text" class="input-service client-info my-3" name="serial_number[]" placeholder="{{ __('common.serial_no') }}" disabled>
                                <input type="text" class="input-service client-info" name="warranty_code[]" placeholder="{{ __('common.warranty_code') }}" disabled>
                            </div>
                        </div>
                    </div>
            </div>
            {{--services--}}
            <div class="card p-8 mb-10">
                <h2 class="fw-bold py-3" style="color: #1C4853">{{ __('common.services') }}</h2>

                @isset($services)
                    @foreach($services as $service)
                        <div class="row g-8 p-2 {{ app()->getLocale() === 'ar' ? 'ps-18' : 'pe-18' }}">
                            <div class="col-md-8">
                                <div class="project-card p-7">
                                    <h5 class="fw-bold brand-name">
                                        @if($service['service_id'] != null)
                                            {{ optional(\App\Models\Service::find($service['service_id']))->service_name }}
                                        @endif
                                    </h5>
                                    @foreach($service['brands'] as $brands)
                                        <p class="item-name">
                                            @if($service['service_id'] != null)
                                                {{ optional(\App\Models\Brand::find($brands['brand_id']))->brand_name }}
                                            @endif
                                            :
                                            @foreach($brands['items'] as $items)
                                                @if($service['service_id'] != null)
                                                    {{ optional(\App\Models\Item::find($items))->item_name }}/
                                                @endif
                                            @endforeach
                                        </p>
                                    @endforeach
                                    @php
                                        $appArea = \App\Models\OrderCosting::where([
                                            'process_id' => $service['process_id'],
                                            'service_id' => $service['service_id']
                                        ])->first();
                                    @endphp

                                    @isset($appArea)
                                        @php
                                            $areas = json_decode($appArea->app_area, true); // decode the JSON string from the column
                                        @endphp

                                        @if(!empty($areas))
                                            <p class="item-name">
                                                @foreach($areas as $area)
                                                    {{ $area }}@if(!$loop->last)/@endif
                                                @endforeach
                                            </p>
                                        @endif
                                    @endisset
                                </div>
                            </div>

                            @php
                            $costing = \App\Models\OrderCosting::where(['process_id'=>$service['process_id'] , 'service_id'=>$service['service_id']])->first();
                             @endphp

                            <div class="col-md-3">
                                <div class="mt-3 mb-3">
                                    @isset($costing->cost)
                                    <label class="fs-sm mb-1" style="color: #B1B5BF">{{ __('common.price_tax') }}</label>
                                    <span class="d-block fw-bold fs-7">{{$costing->cost}}SR</span>
                                    @endisset
                                </div>

                                <div class="mt-3 mb-3">
                                    @isset($costing->serial_number)
                                         <label class="fs-sm mb-1" style="color: #B1B5BF">{{ __('common.serial_no') }}</label>
                                        <span class="d-block fw-bold fs-7">{{$costing->serial_number}}</span>
                                    @endisset

                                </div>

                                <div class="mt-3 mb-3">
                                    @isset($costing->warranty_code)
                                        <label class="fs-sm mb-1" style="color: #B1B5BF">{{ __('common.warranty_code') }}</label>
                                        <span class="d-block fw-bold fs-7">{{$costing->warranty_code}}</span>
                                    @endisset
                                </div>
                            </div>
                        </div>
                        @if (!$loop->last)
                            <hr class="pe-18" style="margin-right: 220px;margin-left: 10px;">
                        @endif
                    @endforeach
                @endisset
            </div>

            <div class="card p-8 mb-10">
                <h2 class="fw-bold py-3" style="color: #1C4853">{{ __('common.administrator') }}</h2>
                @isset($administrator)
                <p>{{$administrator->administrator_name}}</p>
                @endisset
            </div>

            <div class="card p-8 mb-10">
                <h2 class="fw-bold py-3" style="color: #1C4853">{{ __('common.branches') }}</h2>
                @isset($branch_name)
                    <p>{{$branch_name->branch_name}}</p>
                @endisset
            </div>

            <div class="card p-8 mb-10">
                <h2 class="fw-bold py-3" style="color: #1C4853">{{ __('common.car_images') }}</h2>

                @isset($images)
                    <div class="image-container d-flex flex-wrap">
                        @foreach($images as $image)
                            <div  class="image-item position-relative me-2 mb-2" id="image-{{$image->id}}">
                                <img src="{{ asset('storage/' . $image->image) }}" alt="Car Image" class="img-thumbnail" style="width: 150px; height: 150px;">
                                <!-- Delete Icon -->
                                <span id="{{ $image->id }}" class="text-danger removePhoto" style="cursor: pointer; position: absolute; top: 5px; right: 5px; font-weight: bold;">X</span>

                            </div>
                        @endforeach
                    </div>
                @endisset

                <div class="text-center image-upload d-none">
                    <p class="fs-4">{{ __('common.take_car_images') }}</p>
                    <div class="d-flex justify-content-center align-items-center">
{{--                        <input type="file" name="images[]" class="file-input2" style="display:none;" id="fileInput" multiple>--}}
                        <input type="file" id="fileInput2" class="file-input2" style="display:none;" multiple />
                        <img src="{{ asset('assets/icons/attach-file-icon2.svg') }}" width="65" height="65" id="uploadTrigger">
                    </div>
                </div>
{{--                <div id="imagePreview"></div>--}}
                <div id="preview"></div>

                <input type="hidden" name="images" id="imagePreviewsInput">

            </div>

            <div class="card p-8 mb-10">
                <h2 class="fw-bold py-3" style="color: #1C4853">{{ __('common.customer_signature') }}</h2>

                <div class="d-flex justify-content-center signature_file d-none">
                    <div class="customer-signature">
                        <img src="{{ asset('assets/icons/attach-file-icon2.svg') }}" width="40" height="40">
                        <span class="fw-bold fs-5" style="color: #1C4853">{{ __('common.customer_signature_file') }}</span>
                    </div>
                </div>


{{--                @if($footer_image != null)--}}
{{--                    <img src="{{ asset('storage/' . $footer_image) }}" alt="Signature" width="200" style="height: 65px">--}}
{{--                @endif--}}

                @if($signature != null)
                    <img src="{{ asset('storage/' . $signature) }}" alt="Signature" width="200" style="height: 65px">
                @endif

                <div class="signature-show d-none">
                    <div class="wrapper">
                        <canvas id="signature-pad" width="400" height="200"></canvas>
                    </div>

                    <input type="hidden" name="signature" id="signature-data">

                    <div class="clear-btn">
                        <button id="clear" type="button"><span> Clear </span></button>
                    </div>
                </div>

            </div>

            <div class="card p-8 mb-10">
                <h2 class="fw-bold py-3" style="color: #1C4853">{{ __('common.cost') }}</h2>
                @isset($costingService)
                    @php
                        $totalCost = collect($costingService)->pluck('cost')->sum();
                    @endphp

                    @foreach($costingService as $costOrder)
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <p>{{ $costOrder->service_name }}</p>
                            </div>

                            <div class="pe-18">
                                <p class="fw-bold fs-7">{{ $costOrder->cost }}SR</p>
                            </div>
                        </div>
                    @endforeach

                    <hr>

                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h3 style="color: #1C4853">{{ __('common.total_cost') }}</h3>
                        </div>

                        <div class="pe-2">
                            <p><span class="fw-bold fs-7 me-2">{{ $totalCost }}SR</span> {{ __('common.price_tax') }}</p>
                        </div>
                    </div>
                @endisset
            </div>



        </form>
        <div class="work-stages-edit d-flex justify-content-between align-items-center">
            <a href="{{route('companies.work_stages.convert_to_delivery' , $id)}}" class="btn-work-done">{{ __('common.work_done') }}</a>
             <button class="work-stages-btn-edit" onclick='printDiv();'>
                <i class="fa-solid fa-file-arrow-down" style='font-size:20px; color: #B1B5BF'></i>
                {{ __('common.download_pdf') }}
            </button>
        </div>
    </div>
    <!--end::Content container-->
@endsection
@push('footer')
    <script src="{{url('design/admin')}}/assets/js/signature_pad.min.js"></script>

    <script>
        function printDiv() {
            var divToPrint = document.getElementById('DivIdToPrint');
            var newWin = window.open('', 'Print-Window');
            newWin.document.open();
            newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
            newWin.document.close();
            setTimeout(function () {
                newWin.close();
            }, 10);
        }
    </script>

    <script>
        const fileInput = document.getElementById("fileInput2");
        const preview = document.getElementById("preview");
        const hiddenInput = document.getElementById("imagePreviewsInput");
        let allFiles = [];

        fileInput.addEventListener("change", function (e) {
            const selectedFiles = Array.from(e.target.files);

            // Add newly selected files to the list
            allFiles = allFiles.concat(selectedFiles);

            // Clear and re-preview everything
            preview.innerHTML = "";
            const base64Array = [];

            allFiles.forEach((file, index) => {
                if (file.type.startsWith("image/")) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const base64 = e.target.result;
                        base64Array.push(base64); // Store in array

                        const img = document.createElement("img");
                        // img.src = e.target.result;
                        img.src = base64;
                        img.style.maxWidth = "150px";
                        img.style.margin = "5px";
                        preview.appendChild(img);

                        // Update hidden input value after all images are loaded
                        if (base64Array.length === allFiles.length) {
                            hiddenInput.value = JSON.stringify(base64Array);
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Clear file input value so user can select same file again if needed
            fileInput.value = "";
        });
    </script>

    <script>
        /*start upload image*/
        const uploadTrigger = document.getElementById("uploadTrigger");
        // const fileInput = document.getElementById("fileInput2");
        uploadTrigger.addEventListener("click", function() {
            fileInput.click();
        });

       /* $(document).ready(function () {
            const $fileInput = $('#fileInput');
            const $uploadTrigger = $('#uploadTrigger');
            const $preview = $('#imagePreview');
            const allFiles = [];

            $uploadTrigger.on('click', function () {
                $fileInput.click();
            });

            $fileInput.on('change', function (e) {
                const selectedFiles = Array.from(e.target.files);

                selectedFiles.forEach((file) => {
                    if (file.type.startsWith('image/')) {
                        allFiles.push(file); // Accumulate!

                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const img = $(`
                        <img src="${e.target.result}" alt="Image Preview"
                             class="img-thumbnail m-2" style="max-width: 150px; height: auto;">
                    `);
                            $preview.append(img);
                        };
                        reader.readAsDataURL(file);
                    }
                });

                // Let user pick same file again
                $fileInput.val('');
            });

            $('#imageForm').on('submit', function (e) {
                e.preventDefault(); // Stop default form submission

                const formData = new FormData();
                allFiles.forEach((file) => {
                    formData.append('images[]', file);
                });

                // Add CSRF token if needed (for Laravel)
                formData.append('_token', $('input[name="_token"]').val());

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        alert('Uploaded successfully!');
                        // Optionally: reset form, preview, and allFiles
                    },
                    error: function (err) {
                        alert('Upload failed.');
                    }
                });
            });
        });*/


        /*end upload image*/

        /*start signature*/

        let signaturePad;
        let canvas;
        let selectedServices = [];

        $('.customer-signature').click(function () {
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

        document.getElementById("myForm").addEventListener('submit', function (e) {
            if (signaturePad && !signaturePad.isEmpty()) {
                const dataUrl = canvas.toDataURL('image/png');
                document.getElementById('signature-data').value = dataUrl;
            }
        });

        /*end signature*/

        $('form input').addClass('disabled');
        $('.edit-disable button').click(function (e) {
            e.preventDefault();
            $(this).closest('.edit-disable').addClass('d-none');
            $('form input').removeClass('disabled');
            $('.edit-submit').removeClass('d-none');
            $('.image-upload').removeClass('d-none');
            $('.signature_file').removeClass('d-none');
            $('.input-service-select').removeClass('disabled');
            $('.custom-select').removeClass('disabled');
        });

        $(document).on('click', '#addBrands .dropdown-item', function (e) {
            e.preventDefault();
            let selectedText = $(this).text();
            let selectedValue = $(this).attr('data-value');

            $('#dropdownMenuButton').text(selectedText);
            $('#selectedOption').val(selectedValue);
        });

        function addBrand(service_name , service_id , brand_id = -1 , brand_name = "", item_id = -1, item_name = "") {
            if (!service_name.trim()) return;

            let existingService = $(".brand-items-added:not(.d-none)").last();
            let clone;

            if (!existingService.length || item_id === -1) {
                clone = $(".brand-items-added").first().clone().removeClass("d-none");
                clone.find(".brand-name").text(service_name);
                clone.append(`<input type="hidden" name="service_id[]" value="${service_id}">`);
                clone.find(".input-service").removeAttr('disabled')
                $(".brand-items-added").last().after(clone);
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
                const element = $(this);

                const classParent = element.closest('.new-service');

                const serviceID = classParent.find("input[name='service_id[]']").val();

                selectedServices = selectedServices.filter(id => id !== serviceID);
                /*console.log('Deleted service:', serviceID);*/

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

        /*ADD SERVICE*/
        let previousServiceId = $('#addService').val(); // Initialize previous service

        $('#addService').on('focus', function() {
            // Store current value when dropdown is focused
            previousServiceId = $(this).val();
        });
        $('#addService').change(function() {
            var serviceId = $(this).val();


            let itemAreaSelected  = $(".area-selected").last();
            let brandSelected     = $(".item-selected").last();
            let visibleNewService = $('.new-service:visible');

            if (!brandSelected.is(':visible') && visibleNewService.length !== 0 ) {
                alert('Please complete service data ( choose item) !');
                $(this).val(previousServiceId);
                return;
            }

            if (!itemAreaSelected.is(':visible') && visibleNewService.length !== 0 ) {
                alert('Please complete service data ( application area) !');
                $(this).val(previousServiceId);
                return;
            }

            if (selectedServices.includes(serviceId)) {
                alert('This service is already selected!');
                $(this).val(previousServiceId);
                return;
            } else {
                selectedServices.push(serviceId);
                console.log('Service added:', selectedServices);
            }

            $('input[name="application_area[]"]').prop('checked', false).prop('disabled', false);

            if (serviceId) {
                $.ajax({
                    url: "{{ route('companies.work_stages.get_brands') }}",
                    type: "GET",
                    data: { service_id: serviceId },
                    success: function(response) {
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

        $(document).ready(function() {
            // Function to update image count
            function updateImageCount() {
                let imageCount = $('.image-item').length; // Count number of images displayed
                console.log("Number of images displayed:", imageCount);

                // If less than 4 images, show the upload input
                if (imageCount < 4) {
                    $('#file-input-container').removeClass('d-none');
                }

                return imageCount;
            }
            $(document).on('change', '.images', function () {
                const countImage = updateImageCount(); // Get latest count
                const showInput = 4 - countImage; // Allow max 4 images

                const totalInputs = $('#file-input-container .file-input').length;

                if (totalInputs >= showInput) {
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
            // Call once on page load
            updateImageCount();
            // Function to update file input fields based on deleted images
            function updateFileInputs(deletedCount) {

                let fileInputContainer = $('#file-input-container');
                fileInputContainer.empty(); // Clear previous inputs

                for (let i = 0; i < deletedCount; i++) {
                    let newInput = `
                <div class="file-input" style="padding-bottom: 10px; padding-top: 10px">
                    <label for="images">Upload Images:</label>
                    <input type="file" name="images[]" class="images" multiple>
                </div>
            `;
                    fileInputContainer.append(newInput);
                }

                // Show the file input container if images were deleted
                if (deletedCount > 0) {
                    fileInputContainer.removeClass('d-none');
                }
            }
            // Attach click event for delete buttons
            $(document).on('click', '.removePhoto', function() {
                let imageID = $(this).attr('id'); // Get image ID
                let imageElement = $('#image-' + imageID);

                $.ajax({
                    url: "{{ url('/companies/setting/work-stages/delete-image') }}/" + imageID,
                    type: "GET",
                    success: function(response) {
                        if (response) {
                            imageElement.fadeOut(300, function() {
                                $(this).remove();

                                let remainingImages = updateImageCount(); // Get updated count of images
                                let deletedCount = $('.image-item').length - remainingImages + 1; // Number of deleted images

                                updateFileInputs(deletedCount); // Update file inputs
                            });
                        } else {
                            alert('Failed to delete image.');
                        }
                    },
                    error: function(xhr) {
                        console.log("Error:", xhr.responseText);
                        alert('Something went wrong!');
                    }
                });
            });
            updateImageCount();



            /*add new service*/

        });

        function toggleDropdown() {
            const select = document.querySelector('.custom-select');
            if (select.classList.contains('disabled')) return;

            select.classList.toggle('active');
        }

        document.addEventListener('click', function (event) {
            const select = document.querySelector('.custom-select');
            if (!select.contains(event.target)) {
                select.classList.remove('active');
            }
        });

        function addAreasToServiceItem(){
            $('input[name="application_area[]"][value="Full Vehicle"]').change(function () {
                if ($(this).is(':checked')) {

                    // uncheck for all without  $(this) check-input
                    $('input[name="application_area[]"]').not(this).prop('checked', false).prop('disabled', true);

                } else {
                    // Re-enable all checkboxes
                    $('input[name="application_area[]"]').prop('disabled', false);
                }
            });

            setTimeout(() => {
                // get areas checked
                let selectedAreas = [];
                $('input[name="application_area[]"]:checked').each(function () {
                    selectedAreas.push($(this).val());
                });

                console.log("Selected Areas:", selectedAreas);

                let cloneArea = $(".area-selected").last().removeClass("d-none");
                cloneArea.find(".area-name").text(selectedAreas.join(' / '));
                cloneArea.find(".hidden-app-area").val(selectedAreas.join(', ')).removeAttr('disabled');
            }, 10);
        }

        $(document).ready(function () {
            function makeSafeId(value) {
                return value.replace(/\s+/g, '-').replace(/[()]/g, '').toLowerCase();
            }

            $('input[name="application_area[]"][value="Full Vehicle"]').change(function () {
                /*$('#selected-app-area').removeClass('d-none');*/
                if ($(this).is(':checked')) {
                    // Disable and uncheck all other checkboxes
                    $('input[name="application_area[]"]').not(this).prop('disabled', true).prop('checked', false);

                    // Remove all other selected elements except Full Vehicle
                    $('#selected-app-area').children('p').not('#app-area-full-vehicle').remove();

                    // Add Full Vehicle to selected list if not already there
                    /* if ($('#app-area-full-vehicle').length === 0) {
                         $('#selected-app-area').append('<p id="app-area-full-vehicle">Full Vehicle</p>');
                     }*/
                } else {
                    $('input[name="application_area[]"]').prop('disabled', false);
                    $('#app-area-full-vehicle').remove(); // Remove Full Vehicle from selected list
                }
            });

            $('input[name="application_area[]"]').click(function () {
                let visibleNewService = $('.new-service:visible');

                if (visibleNewService.length === 0) {
                    $('input[name="application_area[]"]').prop('checked', false);

                    alert('Please Select Service First !');
                    return;
                }

                const value = $(this).val();
                const id = makeSafeId(value);

                /* $('#selected-app-area').removeClass('d-none');*/
                if ($(this).is(':checked')) {
                    if ($(`#app-area-${id}`).length === 0) {
                        $('#selected-app-area').append(`<p id="app-area-${id}">${value}</p>`);
                    }
                } else {
                    $(`#app-area-${id}`).remove();
                }

                addAreasToServiceItem();
            });
        });

        function checkValidatedData() {
            let itemAreaSelected = $(".area-selected").last();
            let brandSelected = $(".item-selected").last();
            let visibleNewService = $('.new-service:visible');

            if (!brandSelected.is(':visible') && visibleNewService.length !== 0) {
                alert('Please complete service data (choose item)!');
                return false;
            }

            if (!itemAreaSelected.is(':visible') && visibleNewService.length !== 0) {
                alert('Please complete service data (application area)!');
                return false;
            }

            return true;
        }

        /*$("#myForm").submit(function (e) {
            let formattedData = collectData();
            generateInputsFromData(formattedData);
        });*/

        document.addEventListener("DOMContentLoaded", () => {
            const form = document.querySelector("#myForm");

            form.addEventListener("submit", function(event) {
                event.preventDefault();

                if (checkValidatedData()) {
                    let formattedData = collectData();
                    generateInputsFromData(formattedData);
                    form.submit();
                }
            });
        });
    </script>
@endpush
