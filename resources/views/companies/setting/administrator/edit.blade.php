@extends('admin_panel.layout.master')

@section('title')
    {{ __('common.system_administrators') }}
@endsection

@push('header')
@endpush

@section('content')
    <!-- Main Content -->
    <div class="p-7">
        <h1 class="home-h1 mb-8">{{ __('common.settings') }} / {{ __('common.system_administrators') }}</h1>

        <form class="card p-4 mb-4"
            action="{{route('companies.setting.company.update.administrator' , $administrator->id)}}"
            enctype="multipart/form-data"
            method="post">
            @csrf
            <div class="home-subscription d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-end">
                    <img src="{{ asset('assets/imgs/hub.png') }}" style="transform: rotate(270deg);">
                    <h5 class="service-h5" style="margin-bottom: 3px">{{ __('common.add_new_administrators') }}</h5>
                </div>

                <button type="submit" class="service-save-btn btn btn-outline-secondary" style="font-size: 15px !important;">{{ __('common.save') }}</button>
            </div>

            <div class="py-10 px-20 d-flex align-items-center" id="new-branch-input">
                <input type="text" name="administrator_name"
                       class="input-service" value="{{$administrator->administrator_name}}"
                       width="90%" id="branch-input">

                <div class="icon-container mx-3">
                    <span id_branch="{{$administrator->id}}" class="plus-icon" id="plus-icon">X</span>
                </div>
            </div>

        </form>
    </div>
    <!--end::Content container-->
@endsection

@push('footer')
    <script>
        $(document).ready(function () {

            $("#plus-icon").on('click', function () {
                const branch_id = $(this).attr('id_branch');
                $.ajax({
                    url: "{{ url('/companies/setting/system-administrator/delete') }}/" + branch_id,
                    type: "GET",
                    success: function(response) {
                        if (response.success) {
                            alert('Branch deleted successfully.');
                            window.location.href = "{{ route('companies.setting.administrator') }}";
                        } else {
                            alert(response.message || 'Failed to delete branch.');
                        }
                    },
                    error: function(xhr) {
                        console.log("Error:", xhr.responseText);
                        alert('Something went wrong!');
                    }
                });
            });
        });
    </script>
@endpush
