@extends('admin_panel.layout.master')

@section('title')
    {{ __('common.add_branches') }}
@endsection

@push('header')
@endpush

@section('content')
    <!-- Main Content -->
    <div class="p-7">
        <h1 class="home-h1 mb-8">{{ __('common.settings') }} / {{ __('common.add_branches') }}</h1>

        <form class="card p-4 mb-4"
              action="{{route('companies.setting.company.save.branch')}}"
              enctype="multipart/form-data"
              method="post">
            @csrf
            <div class="home-subscription d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-end">
                    <img src="{{ asset('assets/imgs/hub.png') }}" style="transform: rotate(270deg);">
                    <h5 class="service-h5" style="margin-bottom: 3px">{{ __('common.add_branches') }}</h5>
                </div>

                <button type="submit" class="service-save-btn btn btn-outline-secondary" style="font-size: 15px !important;">{{ __('common.save') }}</button>
            </div>

            <div class="p-8">
                <div class="link-box" id="click-add">
                    {{ __('common.add_branches') }}
                </div>
            </div>

            <div class="d-none py-10 px-20 d-flex align-items-center" id="new-branch-input">
                <input type="text" class="input-service"
                       placeholder="{{ __('common.branch_name') }}" width="90%" id="branch-input">
                <div class="icon-container mx-3">
                    <span class="plus-icon" id="plus-icon">+</span>
                </div>
            </div>

            <div class="new-branch py-2 px-20">
                <div class="clone-branch d-none d-flex align-items-center justify-content-between">
                    <h5 class="branch-name-view"></h5>

                    <button class="btn-deleted">
                        <i class="fa-solid fa-delete-left"></i>
                        {{ __('common.delete') }}
                    </button>
                </div>
            </div>

        </form>
    </div>
    <!--end::Content container-->
@endsection

@push('footer')
    <script>
        $(document).ready(function () {
            $('#click-add').on('click', function () {
                $('#new-branch-input').removeClass('d-none');
            })

            function addCloneBranch(branch_name) {
                if (!branch_name.trim()) return;

                let clone = $(".clone-branch").first().clone().removeClass("d-none");
                clone.find('.branch-name-view').text(branch_name);
                clone.append(`<input type="hidden" name="branch_name[]" value="${branch_name}">`);

                $(".clone-branch").last().after(clone);

                let separator = $("<hr>");

                $(".new-branch").append(clone).append(separator);

                clone.find(".btn-deleted").click(function () {
                    $(this).closest(".clone-branch").next("hr").remove();
                    $(this).closest(".clone-branch").remove();
                });
            }

            $("#plus-icon").on('click', function () {
                let branchName = $('#branch-input').val();

                if (!branchName) {
                    alert('Please enter branch name first');
                    return;
                }
                addCloneBranch(branchName);
                $('#branch-input').val("");
            });
        });
    </script>
@endpush
