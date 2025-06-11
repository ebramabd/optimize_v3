@extends('admin_panel.layout.master')

@section('title')
    {{ __('common.home') }}
@endsection

@push('header')
@endpush

@section('content')
    <div class="p-7">
        <h1 class="home-h1 mb-8">{{ __('common.home') }}</h1>
        <div class="card p-4 mb-4">
            <a href="{{route('companies.setting.subscriptions')}}">
                <div class="home-subscription d-flex align-items-end">
                    <img src="{{ asset('assets/imgs/subscription.svg') }}">
                    <h5>{{ __('common.subscriptions') }}</h5>
                </div>
            </a>
            @php
                $trialEndsAt = optional(auth()->guard('company')->user())->trial_ends_at;
            @endphp
            @if(!is_null($trialEndsAt) && now()->lte($trialEndsAt))
                <div class="ps-7">
                    <div class="home-package d-flex align-items-center justify-content-between">
                        <p>{{ __('common.trial_package') }}</p>
                        <span class="status-active">{{ __('common.active') }}</span>
                    </div>

                    <h2 class="fs-2x fw-bold mb-5">14 {{ __('common.day') }}</h2>
                    <p>Your trial ends on {{ $subscription->format('Y-m-d') }}</p>



                    <div class="home-checked d-flex">
                        <img src="{{ asset('assets/imgs/checked.svg') }}">
                        <span class="mx-2">{{ __('common.your_plan') }}</span>
                    </div>

                    <p class="mb-1" style="color:#212330;"><strong>{{ __('common.my_premium_benefits') }}</strong></p>
                    <ul class="home-benefits">
                        <li class="">
                            <img src="{{ asset('assets/imgs/checked.svg') }}" style="width: 13px; height: 30px">
                            <span>{{ __('common.car_system') }}</span>
                        </li>
                        <li>
                            <img src="{{ asset('assets/imgs/checked.svg') }}" style="width: 13px; height: 30px">
                            <span>{{ __('common.controlling_material') }}</span>
                        </li>
                        <li>
                            <img src="{{ asset('assets/imgs/checked.svg') }}" style="width: 13px; height: 30px">
                            <span>{{ __('common.warranty_system') }}</span>
                        </li>
                    </ul>
                    @if ($subscription->isFuture())
                        @php
                            $diffInDays = now()->diffInDays($subscription, false);
                        @endphp

                        @if ($diffInDays <= 5 && $diffInDays >= 0)
                            <p style="color: red">Your trial ends in {{ $diffInDays }} day</p>
                        @endif
                    @endif
                </div>
            @elseif (is_array($subscription) && isset($subscription['subscription']))
                <div class="ps-7">
                    <div class="home-package d-flex align-items-center justify-content-between">
                        <p>{{$subscription['subscription']->title}}</p>
                        <span class="status-active">{{ __('common.active') }}</span>
                    </div>

                    <h2 class="fs-2x fw-bold mb-5">{{$subscription['subscription']->period}} {{ __('common.day') }}</h2>
                    <p>Ends on: {{ $subscription['end_date']->format('Y-m-d') }}</p>
                    <div class="home-checked d-flex">
                        <img src="{{ asset('assets/imgs/checked.svg') }}">
                        <span class="mx-2">{{ __('common.your_plan') }}</span>
                    </div>

                    <p class="mb-1" style="color:#212330;"><strong>{{ __('common.my_premium_benefits') }}</strong></p>
                    <ul class="home-benefits">
                        @php
                            $descriptions = app()->getLocale() === 'ar' ? ($subscription['subscription']->description_ar ?? '') : ($subscription['subscription']->description ?? '');
                            $descriptionsArray = json_decode($descriptions, true) ?? [];
                        @endphp

                        @foreach($descriptionsArray as $des)
                        <li class="">
                            <img src="{{ asset('assets/imgs/checked.svg') }}" style="width: 13px; height: 30px">
                            <span>{{$des}}</span>
                        </li>
                        @endforeach
                    </ul>

                    @if ($subscription['end_date']->isFuture())
                        @php
                            $diffInDays = now()->diffInDays($subscription['end_date'], false);
                        @endphp

                        @if ($diffInDays <= 5 && $diffInDays >= 0)
                            <p style="color: red">Your Package ends in {{ $diffInDays }} day</p>
                        @endif
                    @endif

                </div>
            @else
                <p>You are not subscribed.</p>
            @endif
        </div>

        <div class="card p-4">
            <a href="{{route('companies.work_stages')}}">
                <div class="home-subscription d-flex align-items-end">
                    <img src="{{ asset('assets/imgs/car-alt-black.svg') }}">
                    <h5>{{ __('common.orders') }}</h5>
                </div>
            </a>
            @isset($orders)
                @foreach($orders as $order)
                    <a href="{{route('companies.work_stages.under_process', $order->id )}}" class="home-order">
                        <div class="order-time">
                            <h6>{{ __('common.order_id') }} /{{$order->order_id}}</h6>
                            @php
                                $date_order = \Carbon\Carbon::parse($order->created_at)->format('j-n-Y');
                            @endphp
                            <h6>{{ __('common.time') }} / {{$date_order}}</h6>
                        </div>

                        <div class="">
                            <h6>{{ __('common.client_full_name') }} : {{$order->name . ' ' . $order->last_name}}</h6>
                            <h6>{{ __('common.phone') }} : {{$order->phone}}</h6>
                            <h6>{{ __('common.email') }} : {{$order->email}}</h6>
                        </div>

                        <div class="status-processing {{ app()->getLocale() === 'ar' ? 'float-start': 'float-end' }}">{{ __('common.under_process') }}</div>
                    </a>
                @endforeach
            @endisset
        </div>
    </div>
@endsection
