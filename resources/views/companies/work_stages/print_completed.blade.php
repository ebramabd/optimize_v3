@extends('admin_panel.layout.master')

@section('title')
    {{ __('common.work_stages') }}
@endsection

@push('header')
@endpush

@section('content')
    <!-- Main Content -->
    <div class="p-7">
        <h1 class="home-h1">{{ __('common.work_stages') }} / {{ __('common.completed') }}</h1>

        <div class="work-stages-edit">
            <button class="work-stages-btn-edit" onclick='printDiv();'>
                <i class="fa-solid fa-file-arrow-down" style='font-size:20px; color: #B1B5BF'></i>
                {{ __('common.download_pdf') }}
            </button>
        </div>

        <div class="d-none" id="DivIdToPrint">
            <div class="print-version" style="">
                <div class="print-container">
                    <div class="img-logo-profile">
                        <img src="{{ asset('storage/' . $company->profile_picture) }}" alt="Company Logo">
                    </div>

                    <h2 class="text-center" style="font-size:10px;font-weight:normal;">اتفاقية تقديم الخدمات</h2>
                    <h2 class="text-center" style="font-size:20px;margin-top:10px;margin-bottom:20px">SERVICE AGREEMENT</h2>

                    <div class="print-section">
                        <div class="print-row">
                            <div class="print-field">
                                <div>
                                    <label style="font-weight: normal; font-size: 10px">مالك المركبة</label>
                                    <label>Owner Name</label>
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

                                <div class="field-value">{{ $branch_name ?? '' }}</div>
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
                                                $areas = \App\Models\OrderCosting::where(['process_id'=>$service['process_id'] , 'service_id'=>$service['service_id']])->first()->app_area;
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

        <form>

            <div class="card p-8 mb-10 new-bootstrap-card">
                <h2 class="fw-bold py-3 new-bootstrap-h2" style="color: #1C4853">{{ __('common.client_info') }}</h2>

                <div class="row g-8 p-2 {{ app()->getLocale() === 'ar' ? 'ps-18' : 'pe-18' }} new-bootstrap-row">
                    <div class="col-md-6 new-bootstrap-col-md">
                        <input type="text" disabled value="{{$client->name}}" name="name" class="input-service client-info" placeholder="{{ __('common.first_name') }}">
                    </div>
                    <div class="col-md-6 new-bootstrap-col-md">
                        <input type="text" disabled value="{{$client->last_name}}" name="last_name" class="input-service client-info" style="height: 45px" placeholder="{{ __('common.last_name') }}">
                    </div>
                    <div class="col-md-6 new-bootstrap-col-md position-relative d-flex align-items-center">
                        <input type="text" disabled value="{{$client->phone}}" name="phone" class="new-ps-20 input-service client-info {{ app()->getLocale() === 'ar' ? 'pe-20' : 'ps-20' }}" style="height: 45px;" placeholder="{{ __('common.phone') }}">
                        <span class="phone-code {{ app()->getLocale() === 'ar' ? 'phone-code-right' : 'phone-code-left' }}">+966</span>
                    </div>
                    <div class="col-md-6 new-bootstrap-col-md">
                        <input type="email" disabled value="{{$client->email}}" name="email" class="input-service client-info" style="height: 45px" placeholder="{{ __('common.email') }}">
                    </div>
                </div>
            </div>

            <div class="card p-8 mb-10 new-bootstrap-card">
                <h2 class="fw-bold py-3 new-bootstrap-h2" style="color: #1C4853">{{ __('common.car_info') }}</h2>

                <div class="row g-8 p-2 {{ app()->getLocale() === 'ar' ? 'ps-18' : 'pe-18' }} new-bootstrap-row">
                    <div class="col-md-6">
                        <label class="fs-6 mb-3">{{ __('common.car_type') }}</label>
                        <input type="text" disabled value="{{$car->type}}" name="type" class="input-service client-info" placeholder="{{ __('common.car_type') }}">
                    </div>

                    <div class="col-md-6 new-bootstrap-col-md">
                        <label class="fs-6 mb-3">{{ __('common.cate') }}</label>
                        <input type="text" disabled value="{{$car->category}}" name="category" class="input-service client-info" placeholder="{{ __('common.cate') }}">
                    </div>

                    <div class="col-md-6 new-bootstrap-col-md">
                        <label class="fs-6 mb-3">{{ __('common.color') }}</label>
                        <input type="text" disabled value="{{$car->color}}" name="color" class="input-service client-info" placeholder="{{ __('common.color') }}">
                    </div>

                    <div class="col-md-6 new-bootstrap-col-md">
                        <label class="fs-6 mb-3">{{ __('common.year_manufacture') }}</label>
                        <input type="text" disabled value="{{$car->year_of_manufacture}}" name="year_of_manufacture" class="input-service client-info" placeholder="{{ __('common.year_manufacture') }}">
                    </div>

                    <div class="col-md-6 new-bootstrap-col-md">
                        <label class="fs-6 mb-3">{{ __('common.plate_no') }}</label>
                        <div class="plate-number">
                            <div class="plate-number-main">
                                <input disabled value="{{$car->plate_number}}" name="plate_number" type="text" class="input-service client-info" style="border-radius: 7px"
                                       placeholder="1234">
                            </div>

                            <div class="plate-number-letters">
                                <input name="first_letter" disabled  value="{{$car->first_letter}}"   maxlength="1" class="inputs-plate plate-letter" placeholder="A">
                                <input name="second_letter" disabled value="{{$car->second_letter}}" maxlength="1" class="inputs-plate plate-letter" placeholder="B">
                                <input name="third_letter" disabled value="{{$car->third_letter}}" maxlength="1" class="inputs-plate plate-letter" placeholder="C">
                            </div>
                        </div>

                    </div>


                    <div class="col-md-6 new-bootstrap-col-md">
                        <label class="fs-6 mb-3">{{ __('common.car_meter_read') }}</label>
                        <div class="plate-number">
                            <div class="plate-number-main">
                                <input disabled value="{{$car->meter_reading}}" name="meter_reading" type="text" class="input-service client-info" style="border-radius: 7px"
                                       placeholder="24366">
                            </div>

                            <span class="span-km">{{ __('common.km') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card p-8 mb-10 new-bootstrap-card">
                <h2 class="fw-bold py-3 new-bootstrap-h2" style="color: #1C4853">{{ __('common.services') }}</h2>
                @isset($services)
                    @foreach($services as $service)
                        <div class="row g-8 p-2 {{ app()->getLocale() === 'ar' ? 'ps-18' : 'pe-18' }} new-bootstrap-row">
                            <div class="col-md-8 new-bootstrap-col-md-8">
                                <div class="project-card p-7 .new.p-7 ">
                                    <h5 class="fw-bold brand-name">
                                        {{\App\Models\Service::where('id', $service['service_id'])->first()->service_name}}
                                    </h5>
                                    @php $meters_used=[] @endphp
                                    @foreach($order_costing as $row)
                                        @php $meters_used[$row->item_id] =$row->meters_used @endphp
                                    @endforeach
                                    {{--                                    @dd($meters_used)--}}
                                    @foreach($service['brands'] as $brands)
                                        <p class="item-name">
                                            {{--                                            {{\App\Models\Brand::where('id', $brands['brand_id'])->first()->brand_name}}--}}
                                            {{--                                            :--}}
                                            @foreach($brands['items'] as $items)

                                                {{\App\Models\Brand::where('id', $brands['brand_id'])->first()->brand_name ?? ''}}-{{\App\Models\Item::where('id', $items)->first()->item_name ?? ''}}
                                                [ Number Of Meters Used = {{$meters_used[$items] }} M]
                                                <br>
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

                            <div class="col-md-2 new-bootstrap-col-md-2">
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

            <div class="card p-8 mb-10 new-bootstrap-card">
                <h2 class="fw-bold py-3 new-bootstrap-h2" style="color: #1C4853">{{ __('common.branches') }}</h2>
                @isset($branch_name)
                    <p>{{$branch_name}}</p>
                @endisset
            </div>

            <div class="card p-8 mb-10 new-bootstrap-card">
                <h2 class="fw-bold py-3 new-bootstrap-h2" style="color: #1C4853">{{ __('common.administrator') }}</h2>
                <p>{{$administrator->administrator_name}}</p>
            </div>

            <div class="card p-8 mb-10 new-bootstrap-card">
                <h2 class="fw-bold py-3 new-bootstrap-h2" style="color: #1C4853">{{ __('common.car_images_start') }}</h2>
                @isset($images)
                    <div class="image-container d-flex flex-wrap">
                        @foreach($images as $image)
                            @if($image->order_status==0)
                                <div class="image-item position-relative me-2 mb-2" id="image-{{$image->id}}">
                                    <img src="{{ asset('storage/' . $image->image) }}" alt="Car Image" class="img-thumbnail" style="width: 150px; height: 150px;">
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endisset

            </div>

            <div class="card p-8 mb-10 new-bootstrap-card">
                <h2 class="fw-bold py-3 new-bootstrap-h2" style="color: #1C4853">{{ __('common.customer_signature_start') }}</h2>

                <div class="d-flex justify-content-center">
                    <div class="customer-signature">
                        @if($start_signature != null)
                            <img src="{{ asset('storage/' . $start_signature) }}" alt="Signature" width="200" style="height: 65px">
                        @endif
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
            <div class="card p-8 mb-10 new-bootstrap-card">
                <h2 class="fw-bold py-3 new-bootstrap-h2" style="color: #1C4853">{{ __('common.car_images_end') }}</h2>
                @isset($images)
                    <div class="image-container d-flex flex-wrap">
                        @foreach($images as $image)
                            @if($image->order_status==1)
                                <div class="image-item position-relative me-2 mb-2" id="image-{{$image->id}}">
                                    <img src="{{ asset('storage/' . $image->image) }}" alt="Car Image" class="img-thumbnail" style="width: 150px; height: 150px;">
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endisset

            </div>

            <div class="card p-8 mb-10 new-bootstrap-card">
                <h2 class="fw-bold py-3 new-bootstrap-h2" style="color: #1C4853">{{ __('common.customer_signature_end') }}</h2>

                <div class="d-flex justify-content-center">
                    <div class="customer-signature">
                        @if($end_signature != null)
                            <img src="{{ asset('storage/' . $end_signature) }}" alt="Signature" width="200" style="height: 65px">
                        @endif
                    </div>
                </div>
            </div>

            <div class="under-process-div" style="background-color: #C5F1E6">
                <h5 class="text-center" style="color: #2FB493">{{ __('common.completed') }}</h5>
            </div>
        </form>
    </div>
    <!--end::Content container-->
@endsection

@push('footer')
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
@endpush
