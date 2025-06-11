@extends('admin_panel.layout.master')

@section('title')
    Edit Service
@endsection

@push('header')
@endpush

@section('content')
    <!-- Main Content -->
    <div class="p-7">
        <h1 class="home-h1 mb-8">Settings / Services / Edit</h1>

        <form class="form"
              action="{{ route('companies.setting.service.add.post', $objectService->id)}}"
              enctype="multipart/form-data"
              method="post">
            @csrf
            <input type="hidden" name="update_service" value="update_service">
            <div class="home-subscription d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-end">
                    <img src="{{ asset('assets/imgs/subscription.svg') }}">
                    <h5 class="service-h5">Add New Services</h5>
                </div>

                <button class="service-save-btn btn btn-sm btn-outline-secondary">Save</button>
            </div>

            <div class="p-5">
                <input type="text" class="input-service"
                       value="{{$objectService->service_name}}"
                       name="service_name" placeholder="Service Name">
            </div>

            {{--show  brands exist    {{$objectService->branch_id == null ? 'disabled' : '' }}   --}}


            @isset($services)
                @foreach($services as $service)
                    <div class="card-items-exist p-5">
                    <div class="project-card p-7">
                        <div class="brand-selected flex-between">
                            @php
                            $brand_name = \App\Models\Brand::where('id' , $service->brand_id)->first()->brand_name ?? ''
                            @endphp
                            <h5 class="fw-bold brand-name">{{$brand_name ?? ''}}</h5>

                            <div class="delete-icon delete-icon-brand delete-brand"
                                 id_brand="{{$service->brand_id}}"
                                 id_service="{{$service->service_id}}"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M6 6L18 18M6 18L18 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        @php
                            $items_ids = json_decode($service->item_id);
                        @endphp
                        @foreach($items_ids as $item_id)
                            <div class="item-selected flex-between">
                                @php
                                    $item_name = \App\Models\Item::where('id' , $item_id)->first()->item_name ?? ''
                                @endphp
                                <p class="item-name">{{$item_name ?? ''}}</p>

                                <div class="delete-icon delete-icon-item delete-item"
                                     id_items="{{$item_id}}"
                                     id_brand="{{$service->brand_id}}"
                                     id_service="{{$service->service_id}}"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M6 6L18 18M6 18L18 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                        @endforeach

                        {{--<!-- Delete icons -->
                        <div class="delete-icons-container"></div>--}}
                    </div>

                </div>
                @endforeach
            @endisset

            <div class="py-6 px-8 cursor-pointer" id="add-brand">
                <span class="service-add-brand">Add Brand</span>
            </div>

            <div class="d-none" id="body-add-brand">
                @php
                    $brandSelected = null;

                    if (isset($object) && $object->brand_id) {
                        $brandSelected = \App\Models\Brand::where('id', $object->brand_id)->first();
                    }
                @endphp
                <div class="p-5 fv-row">
                    <label class="fs-6 fw-semibold mb-2">Brands</label>
                    <select class="input-service" name="brand_id" id="brand-select-box">
                        @isset($brands)
                            <option selected value="{{ $brandSelected == null ? '': $brandSelected->id }}">{{ $brandSelected == null ? '': $brandSelected->brand_name}}</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>

                <div class="p-5 d-flex align-items-center">
                    <input type="text" class="input-service" name="brand_name"
                           placeholder="Brand Name" width="90%" id="brand-input">
                    <div class="icon-container">
                        <span class="plus-icon" id="plus-icon-brand">+</span>
                    </div>
                </div>

                <div class="p-5 fv-row">
                    <label class="fs-6 fw-semibold mb-2">Products</label>
                    <select class="input-service" name="prod_id" id="item-select-box">
                        <option value="">Choose</option>
                        @isset($items)
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>

                <div class="p-5 d-flex align-items-center">
                    <input type="text" class="input-service" name="product_name"
                           placeholder="Product Name" width="90%" id="item-input">
                    <div class="icon-container">
                        <span class="plus-icon" id="plus-icon-item">+</span>
                    </div>
                </div>
            </div>

            <div class="d-none brand-items-added p-5">
                <div class="project-card p-7">
                    <div class="brand-selected flex-between">
                        <h5 class="fw-bold brand-name"></h5>

                        <div class="delete-icon delete-icon-brand">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M6 6L18 18M6 18L18 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>

                    <div class="d-none item-selected flex-between">
                        <p class="item-name"></p>

                        <div class="delete-icon delete-icon-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M6 6L18 18M6 18L18 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>

                    {{--<!-- Delete icons -->
                    <div class="delete-icons-container"></div>--}}
                </div>

                <!-- Delete button -->
                <button class="delete-btn mt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                        <path d="M3 6h18M9 6v12M15 6v12M4 6l1 12c.1 1 .8 2 2 2h10c1.2 0 1.9-1 2-2l1-12M10 6V4c0-.5.4-1 1-1h2c.6 0 1 .5 1 1v2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Delete
                </button>
            </div>
        </form>
    </div>
    <!--end::Content container-->
@endsection

@push('footer')
    <script>
        $(document).ready(function () {
            $('#add-brand').on('click', function () {
                $('#body-add-brand').removeClass('d-none');
            })

            function addBrand(brand_id, brand_name, item_id = -1, item_name = "") {
                if (!brand_name.trim()) return;

                let existingBrand = $(".brand-items-added:not(.d-none)").last();
                let clone;

                if (!existingBrand.length || item_id === -1) {
                    clone = $(".brand-items-added").first().clone().removeClass("d-none");
                    clone.find(".brand-name").text(brand_name);
                    clone.append(`<input type="hidden" name="brand_ids[]" value="${brand_id}">`);
                    $(".brand-items-added").last().after(clone);
                } else {
                    clone = existingBrand;
                }

                /*clone.find(".brand-name").text(brand_name);
                // Add hidden input with brand ID
                clone.append(`<input type="hidden" name="brand_ids[]" value="${brand_id}">`);*/

                if (item_id !== -1) {
                    let cloneItem = $(".item-selected").first().clone().removeClass("d-none");
                    cloneItem.find(".item-name").text(item_name);
                    $(".item-selected").last().after(cloneItem);

                    let itemsInput = clone.find("input[name='item_ids[]']");
                    if (itemsInput.length) {
                        let existingItems = itemsInput.val();
                        itemsInput.val(existingItems ? existingItems + "&&" + item_id : item_id);
                    } else {
                        clone.append(`<input type="hidden" name="item_ids[]" value="${item_id}">`);
                    }
                }

                $(".brand-items-added").last().after(clone);

                clone.find(".delete-icon-item").click(function () {
                    let itemElement = $(this).closest(".item-selected");
                    let itemId = itemElement.find("input[name='item_ids[]']").val();
                    let itemsInput = clone.find("input[name='item_ids[]']");

                    // Remove item from the hidden input value
                    let updatedItems = itemsInput.val().split("&&").filter(id => id !== itemId).join("&&");
                    itemsInput.val(updatedItems);

                    itemElement.remove();
                });

                clone.find(".delete-icon-brand").click(function () {
                    clone.remove();
                });

                clone.find(".delete-btn").click(function () {
                    clone.remove();
                });
            }

            function handleBrandSelection() {
                let selectedBrandId = $("#brand-select-box").val();
                let selectedBrand = $("#brand-select-box option:selected").text();
                addBrand(selectedBrandId, selectedBrand);
            }

            function handleItemSelection() {
                let selectedItemId = $("#item-select-box").val();
                let selectedItem = $("#item-select-box option:selected").text();
                let lastBrand = $(".brand-items-added:not(.d-none)").last();

                if (!lastBrand.length || lastBrand.hasClass("d-none")) {
                    alert("Select a brand first.");
                    return;
                }

                addBrand(lastBrand.find("input[name='brand_ids[]']").val(), lastBrand.find(".brand-name").text(), selectedItemId, selectedItem);
            }

            function handleManualBrandAddition() {
                let inputVal = $("#brand-input").val().trim();

                if (inputVal) {
                    addBrand(inputVal, inputVal);
                }

                $("#brand-input").val("");
            }

            function handleManualItemAddition() {
                let inputVal = $("#item-input").val().trim();
                let lastBrand = $(".brand-items-added:not(.d-none)").last();

                if (!lastBrand.length || lastBrand.hasClass("d-none")) {
                    alert("Select a brand first.");
                    return;
                }

                // alert(inputVal);
                if (inputVal) {
                    // alert('after');
                    addBrand(lastBrand.find("input[name='brand_ids[]']").val(), lastBrand.find(".brand-name").text(), inputVal, inputVal);
                }
                $("#item-input").val("");
            }

            $("#brand-select-box").change(handleBrandSelection);
            $("#item-select-box").change(handleItemSelection);
            $("#plus-icon-brand").click(handleManualBrandAddition);
            $("#plus-icon-item").click(handleManualItemAddition);

            $('.delete-item').on('click', function () {
                const $button = $(this);
                const id_items = $(this).attr('id_items');
                const id_brand = $(this).attr('id_brand');
                const id_service = $(this).attr('id_service');

                $.ajax({
                    url: "{{ route('companies.setting.service.delete_items') }}", // Fixed quotes
                    type: "POST",
                    data: {
                        id_items: id_items,
                        id_brand: id_brand,
                        id_service: id_service
                    },
                    success: function (response) {
                        console.log("Success:", response);
                        $button.closest('.item-selected').remove();
                        window.location.href = "{{ route('companies.setting.service') }}";

                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error:", xhr.responseText);
                        alert("An error occurred. Please try again.");
                    }
                });
            });


            $('.delete-brand').on('click', function () {
                const $button = $(this);
                const id_brand = $(this).attr('id_brand');
                const id_service = $(this).attr('id_service');
                $.ajax({
                    url: "{{ route('companies.setting.service.delete_brands') }}", // Fixed quotes
                    type: "POST",
                    data: {
                        id_brand: id_brand,
                        id_service: id_service
                    },
                    success: function (response) {
                        console.log("Success:", response);
                        $button.closest('.card-items-exist').remove();
                        window.location.href = "{{ route('companies.setting.service') }}";
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error:", xhr.responseText);
                        alert("An error occurred. Please try again.");
                    }
                });
            });

        });
    </script>
@endpush
