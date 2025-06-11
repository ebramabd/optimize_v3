@extends('layout.general')

@section('content')
    <div class="wrapper">
        <div class="verification-code-container col-12">
            <h3>Verification Code</h3>
            <p>Please Check Your Inbox , Retrieve The Code <br> And Enter It In The Field Below To Complete The Signup Process</p>
            <form id="recover-password-form" method="POST" action="{{route('verify-phone-code-recover-password')}}">
                @csrf
                <div class="code-digits">
                    <input type="hidden" value="" id="otp_code" name="code">
                    <input type="hidden" value="{{$unique_key}}" name="unique_key" >
                    <input type="hidden" value="{{$companyId}}" name="companyId" >

                    <input type="text" class="form-control code-digit" style="color: black !important;" maxlength="1">
                    <input type="text" class="form-control code-digit" style="color: black !important;"  maxlength="1">
                    <input type="text" class="form-control code-digit" style="color: black !important;" maxlength="1">
                    <input type="text" class="form-control code-digit" style="color: black !important;" maxlength="1">
                    <input type="text" class="form-control code-digit" style="color: black !important;" maxlength="1">
                    <input type="text" class="form-control code-digit" style="color: black !important;" maxlength="1">
                </div>
                <button type="submit" class="main-btn col-12 login-btn">Verify</button>
            </form>
        </div>
    </div>
@endsection



@section('scripts')
    <script>

        $(function() {
            let uniqueKey = "{{$unique_key}}";

            $(document).on('click', '.main-btn', function() {
                let otp = getOtpCode();
                if (otp === '' || otp.length < 6) {
                    alert('Please enter the full 6-digit OTP.');
                    return;
                }
                $('#otp_code').val(otp);

                verifyOtp();
            });

            async function verifyOtp() {
                let formData = new FormData(document.querySelector('#recover-password-form'));
                formData.append('_token', getCsrfToken());
                formData.append('unique_key', uniqueKey);
                let url = getUrl();
                let ajax_url = url + '/verify-phone-code-recover-password';
                let ajax_method = 'POST';
                var res = await makeAjax(ajax_url, ajax_method, formData);
                if (!res['verifyPhoneCodeRes']['status']) {
                    alert('this code not correct');
                } else {
                    alert('success');
                    $(document).trigger('otp_verified', { message: $('#recover-password-form input[name=code]').val() });
                    $('input[name=phone]').attr('readonly', 'readonly');
                }
            }

            function getOtpCode() {
                let otp = '';
                $('.code-digit').each(function() {
                    otp += $(this).val().trim();
                });
                return otp;
            }
        });
    </script>
@endsection
