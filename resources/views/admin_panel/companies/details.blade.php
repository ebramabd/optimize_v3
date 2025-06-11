@extends('admin_panel.layout.master')
@section('title')
    {{ __('admin.details') }} {{ __('admin.company') }}
@endsection

@push('header')
@endpush

@section('content')
    <style>
        .container {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .file-card {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            min-width: 250px;
        }

        h2 {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .file-link {
            display: inline-block;
            padding: 10px 15px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            border-radius: 5px;
            transition: 0.3s;
        }

        .file-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }

    </style>
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl mb-4">
    </div>
    <!--end::Content container-->
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="row">
            <!-- left card -->
            <div class="card card-flush py-10">

                    <!--begin::Modal body-->
                    <div class="modal-body px-lg-17">

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.company_name') }}</label>
                            <input type="text"
                                   style=" color: black; font-weight: bold; "
                                   class="form-control highlight-input"
                                   name="carType" value="{{ $object->company_name }}" disabled
                            />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.trade_name') }}</label>
                            <input type="text"
                                   style=" color: black; font-weight: bold; "
                                   class="form-control highlight-input"
                                   name="carType" value="{{ $object->trade_name }}" disabled
                            />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.commercial_no') }}</label>
                            <input type="text"
                                   style=" color: black; font-weight: bold; "
                                   class="form-control highlight-input"
                                   name="carType" value="{{ $object->commercial_registration_number }}" disabled
                            />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.tax_no') }}</label>
                            <input type="text"
                                   style=" color: black; font-weight: bold; "
                                   class="form-control highlight-input"
                                   name="carType" value="{{ $object->tax_number }}" disabled
                            />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.owner_name') }}</label>
                            <input type="text"
                                   style=" color: black; font-weight: bold; "
                                   class="form-control highlight-input"
                                   name="carType" value="{{ $object->owner_name }}" disabled
                            />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.phone') }}</label>
                            <input type="text"
                                   style=" color: black; font-weight: bold; "
                                   class="form-control highlight-input"
                                   name="carType" value="{{ $object->phone_number }}" disabled
                            />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('common.email') }}</label>
                            <input type="text"
                                   style=" color: black; font-weight: bold; "
                                   class="form-control highlight-input"
                                   name="carType" value="{{ $object->email }}" disabled
                            />
                        </div>

                        @php
                        $user_type = \App\Enums\CompanyStatus::getSpecificStatus($object->status)
                         @endphp
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">{{ __('admin.status') }}</label>
                            <input type="text"
                                   style=" color: black; font-weight: bold; "
                                   class="form-control highlight-input"
                                   name="carType" value="{{ $user_type }}" disabled
                            />
                        </div>



                        @if(!now()->greaterThan($object->trial_ends_at))
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Current subscription</label>
                            <input type="text"
                                   style=" color: black; font-weight: bold; "
                                   class="form-control highlight-input"
                                   name="carType" value="Trial Package" disabled
                            />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">End Date Package</label>
                            <input type="text"
                                   style=" color: black; font-weight: bold; "
                                   class="form-control highlight-input"
                                   name="carType" value="{{$object->trial_ends_at}}" disabled
                            />
                        </div>
                        @endif

                        @if($activeSubscription)
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Current subscription</label>
                                <input type="text"
                                       style=" color: black; font-weight: bold; "
                                       class="form-control highlight-input"
                                       name="carType" value="{{\App\Models\Subscription::where('id' , $activeSubscription->subscription_id)->first()->title}}" disabled
                                />

                            </div>

                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Start date subscription</label>
                                <input type="text"
                                       style=" color: black; font-weight: bold; "
                                       class="form-control highlight-input"
                                       name="carType" value="{{$activeSubscription->start_date}}" disabled
                                />

                            </div>

                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">end date subscription</label>
                                <input type="text"
                                       style=" color: black; font-weight: bold; "
                                       class="form-control highlight-input"
                                       name="carType" value="{{$activeSubscription->end_date}}" disabled
                                />

                            </div>
                        @else
                            <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Current subscription</label>
                            <input type="text"
                                   style=" color: black; font-weight: bold; "
                                   class="form-control highlight-input"
                                   name="carType" value="No Subscription" disabled
                            />
                            </div>
                        @endif

                    </div>
                <div class="radio-group">
                    <input type="radio" name="branch" value="allBranch" class="add-sub" id="allBranch">
                    <label class="label-design" for="allBranch">Add subscription</label>
                </div>

                <div class="d-none subscription">
                    <form class="form" action="{{route('admin-panel.companies.add_subscription')}}" method="post">
                        @csrf
                        <input type="hidden" name="company_id" value="{{$object->id}}">
                        <div class="fv-row mb-7">
                            <select class="form-select" name="subscription_id">
                                <option>Select Subscription</option>
                                @isset($subscription)
                                    @foreach($subscription as $sub)
                                        <option value="{{$sub->id}}">{{$sub->title}}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>

                        <div class="modal-footer flex-center pt-8">
                            <!--begin::Button-->
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Add subscription</span>
                            </button>
                            <!--end::Button-->
                        </div>
                    </form>
                </div>


                    <div class="container" style="margin-top: 50px">
                        <div class="file-card">
                            <h2>{{ __('admin.commercial_file') }}</h2>
                            @isset($object->file_commercial)
                                <a href="{{ asset('storage/' . $object->file_commercial) }}" target="_blank" class="file-link">
                                    📄 {{ $object->file_commercial }}
                                </a>
                            @endisset
                        </div>

                        <div class="file-card">
                            <h2>{{ __('admin.tax_file') }}</h2>
                            @isset($object->file_tax)
                                <a href="{{ asset('storage/' . $object->file_tax) }}" target="_blank" class="file-link">
                                    📄 {{ $object->file_tax }}
                                </a>
                            @endisset
                        </div>
                    </div>





                <!--end::Modal body-->
            </div>
        </div>
    </div>
    <!--end::Content container-->
@endsection

@push('footer')
    <script>
        $('.add-sub').click(function (){
            $('.subscription').removeClass('d-none')
        })
    </script>
@endpush
