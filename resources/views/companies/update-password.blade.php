@extends('layout.general')

@section('content')
    <x-modals.phone-code-verification-modal />

    <div class="wrapper">
        <div class="recover-password-container col-12">
            <h3>Recover Password</h3>
            <p>Please Enter New Password</p>
            <form id="register-form" action="{{route('update.password')}}" method="post">
                @csrf
                <input type="hidden" name="companyId" value="{{$companyId}}">
                <div class="mb-3">
                    <label for="phone" class="form-label" style="color: #212330 !important;">New password</label>
                    <input type="text" name="password" class="form-control" style="color: black !important" id="password" placeholder="Phone" required>
                </div>

                <button type="submit" class="main-btn col-12 recover-password-btn">Update Password</button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
    </script>
@endsection
