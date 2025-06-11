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

        <div class="work-stages-bts text-center p-8">
            <a href="{{route('companies.work_stages')}}" class="pending-btn me-8">{{ __('common.pending') }}</a>
            <a href="{{route('companies.work_stages.completed')}}" class="pending-btn pending-btn-hover">{{ __('common.completed') }}</a>
        </div>

        <div class="card p-8">
            <div class="py-5">
                <input type="text" id="search" class="input-service" name="search" placeholder="{{ __('common.search_client') }}">
            </div>

            @isset($orders)
                @foreach($orders as $order)
                    <a href="{{route('companies.work_stages.print_completed' , $order->id)}}" class="home-order">

                        <div class="order-time">
                            <h6>{{ __('common.order_id') }}: {{ $order->order_id }}</h6>
                            @php
                                $date_order = \Carbon\Carbon::parse($order->created_at)->format('j-n-Y');
                            @endphp
                            <h6>Time: {{ $date_order }}</h6>
                        </div>

                        <div class="order-info" >
                            <h6 class="client-name">{{ __('common.client_full_name') }}
                                : {{ "{$order->name} {$order->last_name}" }}</h6>
                            <h6 class="client-phone">{{ __('common.phone') }}: {{ $order->phone }}</h6>
                            <h6 class="client-email">{{ __('common.email') }}: {{ $order->email }}</h6>

                        </div>
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
