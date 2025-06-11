@extends('admin_panel.layout.master')

@section('title')
    {{ __('common.subscriptions') }}
@endsection

@push('header')
@endpush

@section('content')

    <style>
        .table-container {
            min-width: 900px;
            background: #fff;
            border-radius: 12px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        thead {
            background-color: #F7F9FF;
            color: #1C2437;
        }

        th, td {
            padding: 16px 20px;
            text-align: left;
        }

        tbody tr {
            border-bottom: 1px solid #e0e0e0;
        }

        tbody tr:hover {
            background-color: #f1f5f9;
        }

        .status-active {
            background: #EFFBF8;
            color: #2FB493;
            padding: 8px 25px;
            border-radius: 10px;
            font-size: 16px;
        }

        .status-expired {
            background: #dc3545;
            color: #fff;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
        }

        .action-btn {
            background-color: #1C4853;
            color: #fff;
            padding: 8px 14px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .action-btn:hover {
            background-color: #163a43;
        }

        .action-btn:hover {
            background-color: #163a43;
        }
      @media (max-width: 768px) {
    .table-container {
        width: 100%;
        overflow-x: auto;
        border-radius: 8px;
    }

    table {
        min-width: 600px; /* يبقى كذا عشان يشتغل التمرير الأفقي */
        font-size: 12px;
    }

    th, td {
        padding: 10px 5px;
        white-space: nowrap; /* يمنع تكسر الكلمات */
    }

    .status-active {
        font-size: 14px;
        padding: 6px 16px;
    }

    .status-expired {
        font-size: 12px;
        padding: 5px 10px;
    }

    .action-btn {
        padding: 6px 10px;
        font-size: 12px;
    }
}

    </style>
    <!-- Main Content -->
    <div class="p-7">
        <h1 class="home-h1 mb-8">{{ __('common.settings') }} / {{ __('common.subscriptions') }}</h1>

        <div class="card p-4 mb-4">
            <div class="home-subscription d-flex align-items-end">
                <img src="{{ asset('assets/imgs/subscription.svg') }}">
                <h5>{{ __('common.subscriptions') }}</h5>
            </div>

            <div class="row g-4 justify-content-center my-20 px-10">

                <!-- Trial Package -->
                @php
                    $trialEndsAt = optional(auth()->guard('company')->user())->trial_ends_at;
                @endphp
                @if(!is_null($trialEndsAt) && now()->lte($trialEndsAt))
                <div class="col-md-4 mb-5">
                    <div class="plan-card text-center">
                        <p class="title-sub">{{ __('common.trial_package') }}</p>
                        <h2 class="plan-price">14 {{ __('common.day') }}</h2>

                        <div class="d-flex align-items-center mb-6">
                            <img src="{{ asset('assets/imgs/checked.svg') }}" style="width: 18px; height: 30px">
                            <span class="mx-2">{{ __('common.your_plan') }}</span>
                        </div>

                        <p class="fw-bold mb-1 {{ app()->getLocale() === 'ar' ? 'text-end'  : 'text-start' }}">{{ __('common.my_premium_benefits') }}</p>
                        <ul class="benefits-list {{ app()->getLocale() === 'ar' ? 'text-end p-0'  : 'text-start' }}">
                            <li><img src="{{ asset('assets/imgs/checked.svg') }}" style="width: 13px; height: 30px"> <span>{{ __('common.car_system') }}</span></li>
                            <li><img src="{{ asset('assets/imgs/checked.svg') }}" style="width: 13px; height: 30px"><span>{{ __('common.controlling_material') }}</span></li>
                            <li><img src="{{ asset('assets/imgs/checked.svg') }}" style="width: 13px; height: 30px"> <span>{{ __('common.warranty_system') }}</span></li>
                        </ul>

                        <button class="active-btn mt-4 {{ app()->getLocale() === 'ar' ? 'btn-transform-rtl'  : '' }}" style="font-size: 18px !important;">{{ __('common.active') }}</button>
                    </div>
                </div>
                @endif

                @isset($subscriptions)
                    @foreach($subscriptions as $sub)
                        <div class="col-md-4 mb-5 subscribed" id-subscription="{{$sub->id}}">
                            <div class="plan-card text-center">
                                @php
                                $currentSub = \App\Models\CompanySubscription::where([
                                    'company_id'=>auth()->guard('company')->id(),
                                    'subscription_id'=>$sub->id
                                    ])->first();
                                @endphp
                                @if(isset($currentSub) && $currentSub->status === \App\Enums\SubscriptionStatus::Active)
                                    <div class="home-package d-flex align-items-center justify-content-between">
                                        <p>{{--{{ __('common.active_package') }}--}}</p>
                                        <span class="status-active">{{ __('common.active') }}</span>
                                    </div>
                                @endif

                                <p class="title-sub">{{ app()->getLocale() === 'ar' ? ($sub->title_ar ?? '') : ($sub->title ?? '') }}</p>
                                @php
                                    $period = '';
                                    if ($sub->period) {
                                        // Convert period to days if needed
                                        $days = (int) $sub->period;

                                        if ($days < 30) {
                                            $period = __('common.daily');
                                        } elseif ($days >= 30 && $days < 365) {
                                            $period = __('common.monthly');
                                        } else {
                                            $period = __('common.yearly');
                                        }
                                    }
                                @endphp
                                <h2 class="plan-price">{{$sub->price}} <img src="{{ asset('assets/imgs/ryal.svg') }}" style="width: 20px; height: 30px"> <span class="plan-duration">/{{ $period }}</span></h2>

                                <hr class="mt-14 mb-8">

                                <p class="fw-bold mb-1 {{ app()->getLocale() === 'ar' ? 'text-end'  : 'text-start' }}">{{ __('common.my_premium_benefits') }}</p>
                                <ul class="benefits-list {{ app()->getLocale() === 'ar' ? 'text-end p-0'  : 'text-start' }}">
                                    @php
                                        $descriptions = app()->getLocale() === 'ar' ? ($sub->description_ar ?? '') : ($sub->description ?? '');
                                        $descriptionsArray = json_decode($descriptions, true) ?? [];
                                    @endphp

                                    @if(!empty($descriptionsArray) && is_array($descriptionsArray))
                                        @foreach($descriptionsArray as $description)
                                            <li>
                                                <img src="{{ asset('assets/imgs/checked.svg') }}" style="width: 13px; height: 30px">
                                                <span>{{ $description }}</span>
                                            </li>
                                        @endforeach
                                    @endif

                                </ul>
                                @php
                                    $companyId = auth()->guard('company')->user()->id;
                                    $current_subscription = \App\Models\CompanySubscription::where('company_id', $companyId)->latest()->first();
                                    $action = 'Change Plan';

                                    if ($current_subscription && $current_subscription->subscription_id == $sub->id) {
                                        $action = 'Renew Package';
                                    }
                                @endphp
                                <button class="change-btn mt-4 {{ app()->getLocale() === 'ar' ? 'btn-transform-rtl'  : '' }}">{{ $action }}</button>
{{--                                __('common.change_plan')--}}
                            </div>
                        </div>
                    @endforeach
                @endisset

                <div style="margin-top: 100px;" class="d-none subscription-body">
                    <div class="card p-8 mb-10">
                        <h2 class="fw-bold py-3" style="color: #1C4853">Bank account information</h2>
                        @php $bankAccount = \App\Models\BankAccount::where('id' , 1)->first() @endphp
                        @isset($bankAccount->bank_account)
<textarea disabled class="form-control"  style="font-family: monospace; resize: none;height: 250px;width: 500px; background-color: #f8f9fa;">
{{$bankAccount->bank_account}}
</textarea>
                        @endisset
                    </div>

                    {{--upload images--}}

                    <form class="card p-4 mb-4 form"
                          action="{{ route('companies.setting.subscription_post')}}"
                          enctype="multipart/form-data"
                          method="post">
                        @csrf
                        <div class="text-center my-12">
                            <p class="fs-4">please upload the conversion image</p>
                            <div class="d-flex justify-content-center align-items-center">
                                <input type="file" name="image" class="file-input2" style="display:none;" id="fileInput">
                                <img src="{{ asset('assets/icons/attach-file-icon2.svg') }}" width="65" height="65" id="uploadTrigger">
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
        </div>

        <div class="card p-8 mb-10">
            <h2 class="fw-bold py-3" style="color: #1C4853">Your Subscription</h2>

            <div class="table-container">
                <table>
                    <thead>
                    <tr>
                        <th>Subscription Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>

                    @isset($my_subscription)
                        @foreach($my_subscription as $sub)
                            <tr>
                                <td>{{\App\Models\Subscription::findOrFail($sub->subscription_id)->title}}</td>
                                <td>{{\Carbon\Carbon::parse($sub->start_date)->format('j-n-Y')}}</td>
                                <td>{{\Carbon\Carbon::parse($sub->end_date)->format('j-n-Y')}}</td>
                                @if($sub->status == \App\Enums\SubscriptionStatus::Active)
                                <td><span class="status-active2">Active</span></td>
                                @endif
                                @if($sub->status == \App\Enums\SubscriptionStatus::Expired)
                                    <td><span class="status-expired">Expired</span></td>
                                @endif
                                @if($sub->status == \App\Enums\SubscriptionStatus::Pending)
                                    <td><span class="status-expired">waiting Request </span></td>
                                @endif
                            </tr>
                        @endforeach
                    @endisset

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--end::Content container-->
@endsection

@push('footer')
    <script>

        $('.subscribed').click(function () {
            $('.subscription-body').removeClass('d-none');
            $('.plan-card').css({ border: "none" });
            $('.form input[name="subscription_id"]').remove();
            const idSubscription = $(this).attr('id-subscription');
            const form = $('.form');
            form.append(`<input type="hidden" name="subscription_id" value="${idSubscription}">`);
            $(this).find('.plan-card').css({ border: "3px solid #1C4853" });
        });


        const uploadTrigger = document.getElementById("uploadTrigger");
        const fileInput = document.getElementById("fileInput");
        uploadTrigger.addEventListener("click", function() {
            fileInput.click();
        });
    </script>
@endpush
