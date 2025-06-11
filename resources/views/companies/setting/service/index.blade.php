@extends('admin_panel.layout.master')

@section('title')
    {{ __('common.services') }}
@endsection

@push('header')
@endpush

@section('content')
    <style>
        .service-card {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            margin-top: 15px;
        }

        .link-box {
            display: block;
            text-decoration: none;
            background-color: transparent;
            border: 2px dashed #4b5563; /* Dashed border */
            padding: 15px 40px;
            border-radius: 10px; /* Rounded edges */
            font-size: 16px;
            font-weight: bold;
            color: #1f2937; /* Dark text color */
            text-align: center;
        }

        .link-box:hover {
            background-color: rgba(0, 0, 0, 0.05); /* Light hover effect */
        }
    </style>
    <!-- Main Content -->
    <div class="p-7">
        <h1 class="home-h1 mb-8">{{ __('common.settings') }} / {{ __('common.services') }}</h1>

        <div class="card p-4 mb-4">
            <div class="home-subscription d-flex align-items-end">
                <img src="{{ asset('assets/imgs/subscription.svg') }}">
                <h5 class="service-h5">{{ __('common.services') }}</h5>
            </div>

            <div class="p-8">
                <a href="{{route('companies.setting.service.add')}}" class="link-box">
                    {{ __('common.add_services') }}
                </a>

                @isset($services)
                    @foreach($services as $service)
                        <div class="card p-6 mt-12">
                            <div class="d-flex align-items-center justify-content-between">
                                <h3 style="color: #1C4853;">{{$service['service_name']}}</h3>

                                <div>
                                    <a href="{{route('companies.setting.service.edit' , $service['service_id'])}}" class="btn btn-sm btn-outline-secondary">{{ __('common.edit') }}</a>
                                    <a class="btn btn-sm btn-outline-danger" href="{{route('companies.setting.service.delete_service' , $service['service_id'])}}">{{ __('common.delete') }}</a>
                                </div>
                            </div>

                            @foreach($service['brands'] as $brand)
                                <div class="service-card">
                                    <strong>{{\App\Models\Brand::where('id' , $brand['brand_id'])->first()->brand_name ?? ''}}</strong>
                                    @foreach($brand['items'] as $item )
                                        <p>{{\App\Models\Item::where('id' , $item)->first()->item_name ?? ''}}<br>
                                    @endforeach
                                </div>
                                <hr />
                            @endforeach
                        </div>
                    @endforeach
                @endisset
            </div>
        </div>
    </div>
    <!--end::Content container-->
@endsection
