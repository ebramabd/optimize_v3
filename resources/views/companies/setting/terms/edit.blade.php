@extends('admin_panel.layout.master')

@section('title')
    Edit Condition
@endsection

@push('header')
@endpush

@section('content')
    <!-- Main Content -->
    <div class="p-7">
        <h1 class="home-h1 mb-8">Settings / Terms Of Agreement / Edit</h1>

        <form class="card p-4 mb-4"
              action="{{route('companies.setting.edit_post_terms',$object->id )}}"
              enctype="multipart/form-data"
              method="post">
            @csrf
            <div class="home-subscription d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-end">
                    <i class="fa-regular fa-calendar" style="font-size: 30px"></i>
                    <h5 class="service-h5" style="margin-bottom: 3px">Edit Condition</h5>
                </div>
                <button class="service-save-btn btn btn-outline-secondary" style="font-size: 15px !important;">Save</button>
            </div>


            <div class="py-10 px-20 d-flex align-items-center" id="new-branch-input">
                <textarea  name="condition"  style="height: 500px" class="form-control" >{{$object->condition_text}}</textarea>
            </div>

            <div class="py-10 px-20 d-flex align-items-center" id="new-branch-input">
                <textarea  name="condition_ar" dir="rtl"  style="height: 500px" class="form-control" >{{$object->condition_text_ar ?$object->condition_text_ar : '' }}</textarea>
            </div>

        </form>
    </div>
    <!--end::Content container-->
@endsection

