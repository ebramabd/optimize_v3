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
                <div class="text-center big-title" >مذكره التسليم</div>
                <div class="text-center small-title" >Delivery Note</div>
            </div>
        </td>
        <td class="text-center">
            @php
                $company = auth()->guard('company')->user()->profile_picture;
            @endphp
            <img src="{{ public_path('storage/' . $company) }}" alt="Company Logo" class="logo-img">
        </td>
    </tr>

    <tr style="background-color: darkblue;padding: 10px ; color: white">
        <td colspan="2">
            <div class="small-title" >Customer Information / ﻣﻌﻠﻮﻣﺎت اﻟﻌﻤﻴﻞ</div>
        </td>

        <td colspan="2">
            <div class="small-title" >Car Information / ﻣﻌﻠﻮﻣﺎت المركبه</div>
        </td>
    </tr>

    <!-- Customer Details -->
    <tr class="info-row">
        <td colspan="2">
            <div class="padding">
                <div class="info-label">المالك / Owner</div>
                <div class="info-value">{{$client->name ?? ''}}</div>
            </div>

            <div class="padding">
                <div class="info-label">البريد / Email</div>
                <div class="info-value">{{$client->email ?? ''}}</div>
            </div>

            <div class="padding">
                <div class="info-label">الجوال / Mobile</div>
                <div class="info-value">{{$client->phone ?? ''}}</div>
            </div>
        </td>

        <td colspan="2">
            <div class="padding">
                <div class="info-label">نوع المركبة / Car Type</div>
                <div class="info-value">{{$car->type ?? ''}}</div>
            </div>

            <div class="padding">
                <div class="info-label">الموديل / Category</div>
                <div class="info-value">{{$car->category ?? ''}}</div>
            </div>

            <div class="padding">
                <div class="info-label">سنة الصنع / Year Of Manufacture</div>
                <div class="info-value">{{$car->year_of_manufacture ?? ''}}</div>
            </div>

            <div class="padding">
                <div class="info-label">رقم الوح / Plate Number</div>
                <div class="info-value">{{ $car->plate_number ?? '' }} {{ $car->first_letter ?? '' }} {{ $car->second_letter ?? '' }} {{ $car->third_letter ?? '' }}</div>
            </div>

            <div class="padding">
                <div class="info-label">قراءة العداد / Car Meter Reading</div>
                <div class="info-value">{{$car->meter_reading ?? ''}}</div>
            </div>
        </td>
    </tr>

    <tr class="info-row-border">
        <td colspan="2">
        </td>
        <td colspan="2" style="margin-right: 0 !important;">
            <div class="padding" style="direction: rtl;">
                <div class="info-label"> اتفاقيه تقديم الخدمات / Service Agreement</div>
                <div class="info-label"> عمل منتهي / Is Job Done / نعم / yes</div>
            </div>
        </td>
    </tr>


    <tr class="">
        <td colspan="2">
        </td>
        <td colspan="2" style="margin-right: 0 !important;">
            <div class="padding" style="direction: rtl;">
                <div class="info-label"> موافقه العميل / Customer Approval</div>
                @isset($signature_completed)
                    <img src="{{ public_path('storage/' . $signature_completed) }}" alt="Company Logo" class="logo-img">
                @endisset
            </div>
        </td>
    </tr>
    <!-- Customer Details -->
</table>

</body>
</html>
