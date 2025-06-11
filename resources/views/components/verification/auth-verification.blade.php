    <form method="POST" action="#" id="verify-otp-form">
        @csrf
        <div class="single-input">
            <label class="label-title mb-2 required" for="code"> {{__('Enter The Code We Sent To')}} {{$phone_number}} </label>
            <input class="form-control" type="text" name="code" id="code" placeholder="{{__('Code')}}" required>
        </div>
        <div class="text-center">
            <button class="mt-4 btn btn-primary verify-otp" type="button"> {{__('Submit')}}</button>
        </div>
    </form>

    <div class="single-input mt-3 mb-3 time-msg">
        {{__('Please Wait')}} <span class="time-counter">{{$available_in_seconds}}</span> {{__('Seconds')}} {{__('Before Request New Code')}}
    </div>

    <script>
        $(function() {
            request_new_code_link = '<p class="confirm-phone-code-btn" style="color: #0d6efd;font-weight: bold; cursor: pointer">' + "{{__('Request New Code')}}" + '</p>';
            var i = "{{$available_in_seconds}}";
            const interval = setInterval(decrement, 1000);

            function decrement() {
                if (--i < 0) {
                    clearInterval(interval);
                    $('.time-msg').html(request_new_code_link);
                }
                $('.time-counter').text(i);

            }

            let uniqueKey = "{{$unique_key}}";

            $(document).on('click', '.verify-otp', function() {
                verifyOtp();
            });
            async function verifyOtp() {
                let formData = new FormData(document.querySelector('#verify-otp-form'));
                formData.append('_token', getCsrfToken());
                formData.append('unique_key', uniqueKey);
                let url = getUrl();
                let ajax_url = url + '/verify-phone-code';
                let ajax_method = 'POST';
                var res = await makeAjax(ajax_url, ajax_method, formData);
                if (!res['verifyPhoneCodeRes']['status']) {
                    alert(res['verifyPhoneCodeRes']['message']);
                } else {
                    alert('success');
                    $(document).trigger('otp_verified', { message: $('#verify-otp-form input[name=code]').val() });
                    // $('.confirm-phone-code-btn').css('display', 'none');
                    $('input[name=phone]').attr('readonly', 'readonly');
                    $('#phone-code-verification-modal').modal('hide'); // If using Bootstrap
                }
            }
        });
    </script>
