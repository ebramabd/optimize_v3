<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
        .page-break {
            page-break-after: always;
        }
    </style>

    <link href="file://{{ public_path('design/admin/assets/css/pdf-terms.css') }}" rel="stylesheet" type="text/css" />
    <link href="file://{{ public_path('design/admin/assets/css/pdf.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>

<table class="print-container">
    <tr>
        <td colspan="2">
            <div style="padding-left: 150px">
                <div class="text-center big-title" >SERVICE AGREEMENT</div>
                <div class="text-center small-title" >اتفاقية تقديم الخدمات</div>
            </div>
        </td>
        <td class="text-center">
            @php
                    $company = auth()->guard('company')->user()->profile_picture;
            @endphp
            @isset($company)
            <img src="{{ public_path('storage/' . $company) }}" alt="Company Logo" class="logo-img">
            @endisset
        </td>
    </tr>

    <!-- Customer Details -->
    <tr class="info-row first-row">
        <td>
            <div class="padding">
                <div class="info-label">المالك / Owner</div>
                <div class="info-value">{{$client->name ?? ''}}</div>
            </div>
        </td>
        <td>
            <div class="padding">
                <div class="info-label">البريد / Email</div>
                <div class="info-value">{{$client->email ?? ''}}</div>
            </div>
        </td>
        <td>
            <div class="padding">
                <div class="info-label">الجوال / Mobile</div>
                <div class="info-value">{{$client->phone ?? ''}}</div>
            </div>
        </td>
    </tr>

    <tr class="info-row">
        <td>
            <div class="padding">
                <div class="info-label">نوع المركبة / Car Type</div>
                <div class="info-value">{{$car->type ?? ''}}</div>
            </div>
        </td>
        <td>
            <div class="padding">
                <div class="info-label">الموديل / Category</div>
                <div class="info-value">{{$car->category ?? ''}}</div>
            </div>
        </td>
        <td>
            <div class="padding">
                <div class="info-label">سنة الصنع / Year Of Manufacture</div>
                <div class="info-value">{{$car->year_of_manufacture ?? ''}}</div>
            </div>
        </td>
    </tr>

    <tr class="info-row">
        <td>
            <div class="padding">
                <div class="info-label">رقم الوح / Plate Number</div>
                <div class="info-value">{{ $car->plate_number ?? '' }} {{ $car->first_letter ?? '' }} {{ $car->second_letter ?? '' }} {{ $car->third_letter ?? '' }}</div>
            </div>
        </td>
        <td>
            <div class="padding">
                <div class="info-label">قراءة العداد / Car Meter Reading</div>
                <div class="info-value">{{$car->meter_reading ?? ''}}</div>
            </div>
        </td>
        <td>
            <div class="padding">
                <div class="info-label">الفرع / Branch</div>
                <div class="info-value">{{$branch_name->branch_name ?? ''}}</div>
            </div>
        </td>
    </tr>

    <tr class="info-row last-row">
        <td>
            <div class="padding">
                <div class="info-label">المسؤل / Administrator</div>
                <div class="info-value">{{ $administrator->administrator_name ?? '' }}</div>
            </div>
        </td>
        <td>
            <div class="padding">
                <div class="info-label">تاريخ الدخول / Check In Date</div>
                <div class="info-value">{{ \Carbon\Carbon::parse($created_at)->format('j-n-Y') ?? '' }}</div>
            </div>
        </td>
        <td>
            <div class="padding">
                <div class="info-label">رقم الطلب / Order Id</div>
                <div class="info-value">{{ $orderID ?? '' }}</div>
            </div>
        </td>
    </tr>
    <!-- Customer Details -->

    <!-- Services Header -->
    <tr class="service-header">
        <td colspan="2">
            <div style="padding: 10px 0">
                الخدمات / Services
            </div>
        </td>
        <td>
            <div style="padding: 10px 0">
                التكلفة / Cost
            </div>
        </td>
    </tr>

    <!-- Service Row -->


    @isset($services)
        @foreach($services as $service)
            <tr class="service-row">
                <td colspan="2">
                    <div class="service">
                        <div class="service-name">
                            {{\App\Models\Service::where('id', $service['service_id'])->first()->service_name}}
                        </div>
                        <div class="service-details">      @isset($service['brands'])
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
                            </p></div>
                    </div>
                </td>
                <td>
                    @php
                        $costing = \App\Models\OrderCosting::where(['process_id'=>$service['process_id'] , 'service_id'=>$service['service_id']])->first();
                    @endphp
                    @isset($costing->cost)
                        <div class="service-cost">{{$costing->cost}}</div>
                    @endisset
                </td>
            </tr>
        @endforeach
    @endisset


    @isset($costingService)
    <tr class="service-row">
        <td colspan="2">
            <div class="service">
                <div class="service-name">total</div>
            </div>
        </td>
        <td>
            @php
                $totalCost = collect($costingService)->pluck('cost')->sum();
            @endphp
            <div class="service-cost">{{$totalCost}}</div>
        </td>
    </tr>
    @endisset

</table>

<div class="page-break"></div>

<!-- Car images table -->
<table class="print-container">
    <!-- Car Images -->
    <tr>
        @isset($images)
            <td colspan="2" class="image-section">
                @foreach($images as $image)
                    @if($image->order_status==0)
                        <img src="{{public_path('storage/' . $image->image)}}" alt="Car Image 1" class="car-image">
                    @endif
                @endforeach
            </td>
        @endisset
    </tr>
</table>

<div class="page-break"></div>

<table class="terms-table">
    <tr>
        <td colspan="2" class="terms-header text-center">
            <h2 style="color:white; font-size: 15px;">Conditions & Terms</h2>
            <h2 style="color:white; font-size: 15px;">الاحكام والشروط</h2>
        </td>
    </tr>

    <tr class="terms-row">
        <td class="terms-column left-column">
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
        </td>
        <td class="terms-column right-column" dir="rtl">
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
        </td>
    </tr>
</table>

</body>
</html>
