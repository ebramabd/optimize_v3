@extends('layout.general')

@section('content')
    <x-modals.phone-code-verification-modal />
    <div class="wrapper">
        <div class="recover-password-container col-12">
            <h3>Recover Password</h3>
            <p>Please Enter The Email And Phone Number You Registered With Us Before</p>
            <form id="register-form" action="{{route('phone-code-verification-recover-password')}}" method="post">
                @csrf
                <input type="hidden" name="unique_key" value="{{$uniquePageKey}}" id="otp-unique-key">
                <input type="hidden" name="action" value="send_code" id="otp-unique-key">
                <input type="hidden" name="otp_code" id="otp_code" value="">
                <div class="mb-3">
                    <label for="email" class="form-label" style="color: #212330 !important;">Email</label>
                    <input type="email" name="email" style="color: black !important" class="form-control" id="email" placeholder="Email" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label" style="color: #212330 !important;">Phone Number</label>
                    <input type="text" name="phone_number" class="form-control" style="color: black !important" id="phone_number" placeholder="Phone" required>
                </div>

                <button type="submit" class="main-btn col-12 recover-password-btn">Recover Password</button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            // your code here

            $(function() {


                $(document).on('otp_verified', function(event, data) {
                    $('#register-form input[name=otp_code]').val(data.message);
                });

                let uniquePageKey = "{{$uniquePageKey}}";
                $(document).on('click', '.main-btn', function() {
                    let phoneNumber = $('#phone_number').val();
                    if (phoneNumber.trim() === '') {
                        // alert('Phone number is empty');
                        return;
                    }
                    let otp_code = $('#otp_code').val();
                    console.log(otp_code)
                    if (otp_code.trim() === '') {
                        // $('#phone-code-verification-modal').modal('show');
                        // confirmPhoneCode();
                    }
                });

                async function confirmPhoneCode() {
                    let url = getUrl();
                    let phoneNumber = $('#phone_number').val();
                    let ajax_url = url + '/send-phone-code-auth-verification-password?action=send_code&phone_number=' + phoneNumber + '&unique_key=' + uniquePageKey;
                    let ajax_method = 'POST';
                    var res = await makeAjax(ajax_url, ajax_method);
                    // $('#phone-code-verification-modal .modal-body').html(res.view);
                }

            });
        });
    </script>
@endsection
