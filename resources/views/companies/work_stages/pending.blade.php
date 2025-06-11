@extends('admin_panel.layout.master')

@section('title')
    {{ __('common.work_stages') }}
@endsection

@push('header')
@endpush

@section('content')
    <!-- Main Content -->
    <div class="p-7">
        <h1 class="home-h1">{{ __('common.work_stages') }} / {{ __('common.pending') }}</h1>

        <div class="work-stages-bts text-center p-8">
            <a href="{{route('companies.work_stages')}}"
               class="pending-btn pending-btn-hover me-8">{{ __('common.pending') }}</a>
            <a href="{{route('companies.work_stages.completed')}}" class="pending-btn">{{ __('common.completed') }}</a>
        </div>

        <div class="card p-8">
            <div class="py-5">
                <input type="text" id="search" class="input-service" name="search"
                       placeholder="{{ __('common.search_client') }}">
            </div>

            @isset($orders)
                @foreach($orders as $order)
                    @php
                        $route = route('companies.home'); // Default route
                        switch ($order->status) {
                            case \App\Enums\OrderStatus::Under_processing:
                                $route = route('companies.work_stages.under_process', $order->id );
                                break;
                            case \App\Enums\OrderStatus::Waiting_For_Delivery:
                                $route = route('companies.work_stages.waiting_delivery', $order->id);
                                break;
                        }
                        $date_order = \Carbon\Carbon::parse($order->created_at)->format('j-n-Y');
                    @endphp

                    <a href="{{ $route }}" class="home-order">
                        <div class="order-time">
                            <h6>{{ __('common.order_id') }}: {{ $order->order_id }}</h6>
                            <h6>{{ __('common.time') }}: {{ $date_order }}</h6>
                        </div>

                        <div class="order-info">
                            <h6 class="client-name">{{ __('common.client_full_name') }}
                                : {{ "{$order->name} {$order->last_name}" }}</h6>
                            <h6 class="client-phone">{{ __('common.phone') }}: {{ $order->phone }}</h6>
                            <h6 class="client-email">{{ __('common.email') }}: {{ $order->email }}</h6>
                        </div>

                        @switch($order->status)
                            @case(\App\Enums\OrderStatus::Under_processing)
                                <div
                                    class="status-processing {{ app()->getLocale() === 'ar' ? 'float-start': 'float-end' }}">{{ __('common.under_process') }}</div>
                                @break
                            @case(\App\Enums\OrderStatus::Waiting_For_Delivery)
                                <div
                                    class="status-waiting-delivery {{ app()->getLocale() === 'ar' ? 'float-start': 'float-end' }}">{{ __('common.waiting_delivery') }}</div>
                                @break
                        @endswitch
                    </a>
                @endforeach
            @endisset
        </div>
    </div>
    <!--end::Content container-->
@endsection

@push('footer')
    <script>
        $(document).ready(function () {
            $("#search").on("keyup", function () {
                var value = $(this).val().toLowerCase();

                $(".home-order").filter(function () {
                    $(this).toggle(
                        $(this).find(".client-name").text().toLowerCase().indexOf(value) > -1 ||
                        $(this).find(".client-phone").text().toLowerCase().indexOf(value) > -1 ||
                        $(this).find(".client-email").text().toLowerCase().indexOf(value) > -1
                    );
                });
            });
        });
    </script>
@endpush
