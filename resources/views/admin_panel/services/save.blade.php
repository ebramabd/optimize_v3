@extends('admin_panel.layout.master')
@section('title')
    {{ __('common.services') }}
@endsection

@push('header')
@endpush

@section('content')
{{--    <style>
/*        .fv-row select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 2px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            color: #333;
            cursor: pointer;
            outline: none;
            transition: all 0.3s ease-in-out;
        }

        !* Style on hover and focus *!
        .fv-row select:hover,
        .fv-row select:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        !* If multiple selection is enabled *!
        .fv-row select[multiple] {
            height: 200px;
            overflow-y: auto;
        }

        !* Custom scrollbar *!
        .fv-row select[multiple]::-webkit-scrollbar {
            width: 8px;
        }

        .fv-row select[multiple]::-webkit-scrollbar-thumb {
            background-color: #007bff;
            border-radius: 4px;
        }

        .fv-row select[multiple]::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .fv-row select option {
            padding: 10px;
            margin: 5px 0;
            background-color: #f8f9fa;
            color: #333;
            border-bottom: 1px solid #ddd;
        }

        !* Hover effect for options (only works in some browsers) *!
        .fv-row select option:hover {
            background-color: #007bff;
            color: #fff;
        }*/
.category {
    font-weight: bold;
}
.subcategory {
    margin-left: 20px;
}
    </style>--}}
<style>
    /*body {*/
    /*    font-family: Arial, sans-serif;*/
    /*    background-color: #f8f9fa;*/
    /*    padding: 20px;*/
    /*}*/

    /*.container {*/
    /*    max-width: 500px;*/
    /*    background: white;*/
    /*    padding: 20px;*/
    /*    border-radius: 10px;*/
    /*    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);*/
    /*}*/

    h3 {
        text-align: center;
        color: #333;
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
                <form class="form"
                      action="{{ route('admin-panel.services.save_post' , object_id($object) )}}"
                      enctype="multipart/form-data"
                      method="post">
                    @csrf
                    <!--begin::Modal body-->
                    <div class="modal-body px-lg-17">
                        <input type="hidden" value="{{object_id($object)}}" name="id">

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2"> {{ __('common.service_name') }}</label>
                            <input type="text" class="form-control" name="service_name"
                                   value="{{field_value($object , 'service_name')}}"/>
                        </div>

                        <h3>{{ __('admin.select_items') }}:</h3>
                        @isset($items)
                            @foreach($items as $item)
                                <label class="category">
                                    <input type="checkbox"
                                           class="parent"
                                           name="brands[]"
                                           value="{{$item['brands']['brand_id']}}"
                                           id="{{$item['brands']['brand_name']}}"> {{ $item['brands']['brand_name'] }}
                                </label>
                                @if(count($item['items']) > 0)

                                    <div class="subcategory">
                                        @foreach($item['items'] as $product)
                                        <label><input type="checkbox" class="child" name="products[]" value="{{$product->id}}" data-parent="{{$item['brands']['brand_name']}}"> {{ $product->item_name }}</label><br>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted">{{ __('admin.no_available') }}</p>
                                @endif

                            @endforeach
                        @endisset

                    </div>

                    <div class="radio-container">
                        <h2 class="h2-terms">{{ __('common.choose') }} {{ __('admin.branch') }}</h2>
                        <div class="radio-group">
                            <input type="radio" name="branch" value="allBranch" id="allBranch">
                            <label class="label-design" for="allBranch">{{ __('admin.all_branch') }}</label>

                            <input type="radio" name="branch" value="oneBranch" id="oneBranch">
                            <label class="label-design" for="oneBranch">{{ __('admin.one_branch') }}</label>
                        </div>
                    </div>

                    <div class="fv-row mb-7" style="display: none" id="branches">
                        <label class="fs-6 fw-semibold mb-2">{{ __('admin.all_branch') }}</label>
                        <select class="form-control" name="branch_id">
                            <option value="">{{ __('admin.select_branch') }}</option>
                            @isset($branches)
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}" >{{ $branch->company_name }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>


                    <div class="modal-footer flex-center pt-8">
                        <!--begin::Button-->
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">{{ __('common.submit') }}</span>
                        </button>
                        <!--end::Button-->
                    </div>
                </form>
                <!--end::Modal body-->
            </div>
        </div>
    </div>
    <!--end::Content container-->
@endsection

@push('footer')
    <script>
        document.querySelectorAll(".parent").forEach(parent => {
            parent.addEventListener("change", function() {
                let children = document.querySelectorAll(`.child[data-parent='${this.id}']`);
                children.forEach(child => child.checked = this.checked);
            });
        });

        document.querySelectorAll(".child").forEach(child => {
            child.addEventListener("change", function() {
                let parent = document.getElementById(this.getAttribute("data-parent"));
                let siblings = document.querySelectorAll(`.child[data-parent='${parent.id}']`);
                let anyChecked = Array.from(siblings).some(sib => sib.checked);
                parent.checked = anyChecked;
            });
        });

        $(document).ready(function () {
            $("input[name='branch']").change(function () {
                if ($("#oneBranch").is(":checked")) {
                    $("#branches").slideDown();
                } else {
                    $("#branches").slideUp();
                }
            });
        });
    </script>
@endpush
