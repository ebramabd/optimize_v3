@extends('admin_panel.layout.master')
@section('title')
    {{ __('common.car_form') }}
@endsection

@push('header')
@endpush

@section('content')
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container-box {
            background: #eef1f6;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .section-title {
            font-weight: bold;
            padding: 10px;
            background: #dde3ea;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .form-control {
            background: #ffffff;
            border: 1px solid #ccc;
            border-radius: 5px;
            height: 45px;
        }
        .plate-input {
            width: 70px;
            text-align: center;
        }
        .km-label {
            font-size: 1.2rem;
            color: #888;
        }

        .category {
            display: block;
            font-weight: bold;
            font-size: 16px;
            margin: 10px 0;
            padding: 10px;
            background: #e9ecef;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .category:hover {
            background: #dee2e6;
        }

        .subcategory {
            margin-left: 20px;
            padding-left: 10px;
            /*border-left: 3px solid #007bff;*/
        }

        .subcategory label {
            display: block;
            padding: 5px 0;
            cursor: pointer;
        }

        input[type="checkbox"] {
            margin-right: 10px;
            transform: scale(1.2);
            cursor: pointer;
        }

        .text-muted {
            color: gray;
            font-style: italic;
            margin-left: 20px;
        }




        .custom-select {
            position: relative;
            /*width: 300px;*/
        }

        .select-box {
            background: white;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .options-container {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-height: 200px;
            overflow-y: auto;
            padding: 10px;
        }

        .options-container label {
            display: block;
            padding: 5px;
            cursor: pointer;
        }

        .options-container input {
            margin-right: 5px;
        }

        .custom-select.active .options-container {
            display: block;
        }

    </style>

    <div class="p-7 my-4">
        <div class="container-box">
            <!-- Client Information -->
            <form class="form"
                  action="{{ route('admin-panel.process-service.save_post')}}"
                  enctype="multipart/form-data"
                  method="post">
                @csrf
                <div class="section-title">{{ __('common.client_info') }}</div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="fs-6 fw-semibold mb-2">{{ __('common.first_name') }}</label>
                        <input type="text" value="{{ $client->name }}" disabled name="name" class="form-control" placeholder="First Name">
                    </div>
                    <div class="col-md-6">
                        <label class="fs-6 fw-semibold mb-2">{{ __('common.last_name') }}</label>
                        <input type="text" value="{{ $client->last_name }}" disabled name="last_name" class="form-control" placeholder="Last Name">
                    </div>
                    <div class="col-md-6">
                        <label class="fs-6 fw-semibold mb-2">{{ __('common.phone') }}</label>
                        <input type="text" value="{{ $client->phone }}" disabled name="phone" class="form-control" placeholder="Phone Number">
                    </div>

                    <div class="col-md-6">
                        <label class="fs-6 fw-semibold mb-2">{{ __('common.email') }}</label>
                        <input type="email" value="{{ $client->email }}" disabled name="email" class="form-control" placeholder="Email">
                    </div>
                </div>

                <!-- Car Information -->
                <div class="section-title mt-4">{{ __('common.car_info') }}</div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ __('common.car_type') }}</label>
                        <input type="text" value="{{ $car->type }}" disabled name="type" class="form-control" placeholder="Car Type">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('common.cate') }}</label>
                        <input type="text" value="{{ $car->category }}" disabled name="category" class="form-control" placeholder="Category">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('common.color') }}</label>
                        <input type="text" value="{{ $car->color }}" disabled name="color" class="form-control" placeholder="Color">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('common.year_manufacture') }}</label>
                        <input type="text" value="{{ $car->year_of_manufacture }}" disabled  name="year_of_manufacture" class="form-control" placeholder="Year Of Manufacture">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('common.plate_no') }}</label>
                        <div class="d-flex">
                            <input type="text" value="{{ $car->plate_number }}" disabled  name="plate_number" class="form-control me-2" placeholder="1234">
{{--                            <input type="text" class="form-control plate-input me-2" placeholder="A">--}}
{{--                            <input type="text" class="form-control plate-input me-2" placeholder="B">--}}
{{--                            <input type="text" class="form-control plate-input" placeholder="C">--}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('common.car_meter_read') }}</label>
                        <div class="d-flex align-items-center">
                            <input type="text" value="{{ $car->meter_reading }}" disabled name="meter_reading" class="form-control me-2" placeholder="">
                            <span class="km-label">{{ __('common.km') }}</span>
                        </div>
                    </div>
                </div>


                <!-- application_area -->
                <div class="section-title mt-4">{{ __('admin.application_area') }}</div>
                <!-- You can add service options here -->
                @isset($application_area)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
                        <ul class="mt-2">
                            @foreach($application_area as $area)
                                <li class="text-gray-700">• {{$area}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endisset

                <!-- Services -->
                <div class="section-title mt-4">{{ __('common.services') }}</div>
                <!-- You can add service options here -->
                @isset($services)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
                        @foreach($services as $service)
                            <div class="bg-white shadow-lg rounded-2xl p-5 border border-gray-200">
                                <h4 class="text-xl font-bold text-blue-600">{{$service['service_name']['service_name']}}</h4>
                                <h6 class="text-gray-500 mb-2">{{$service['brand_name']['brand_name']}}</h6>
                                <ul class="mt-2">
                                    @foreach($service['items'] as $item)
                                        <li class="text-gray-700">• {{$item->item_name}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                @endisset

                {{-- branch --}}
                <div class="section-title mt-4">{{ __('common.branches') }}</div>
                <div class="col-md-12">
                    <select class="form-select" name="branch_id" id="branch-select">
                        <option selected >{{$branch->company_name}}</option>
                    </select>
                </div>

                {{-- administrator --}}
                <div class="section-title mt-4">{{ __('common.administrator') }}</div>
                <div class="col-md-12">
                    <select class="form-select" name="administrator" id="admin-select">
                        <option selected>{{$administrator->administrator_name}}</option>
                    </select>
                </div>

                <div class="section-title mt-4">{{ __('admin.images') }}</div>
                @isset($images)
                    <div class="image-container">
                        @foreach($images as $image)
                            <div class="image-item">
                                <img src="{{ asset('storage/' . $image->image) }}" alt="Car Image">
                            </div>
                        @endforeach
                    </div>
                @endisset

            </form>
        </div>
    </div>
@endsection


