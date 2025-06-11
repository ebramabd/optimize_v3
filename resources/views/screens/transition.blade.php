@extends('layout.general')

@section('content')
<div class="transition-container">
    <div class="brand-logo-medium">Automize</div>
    <div class="please-check-inbox">Please Check Your Inbox</div>
    <p class="">Your Account Password Recovery Details</p>
    <p>Have Been Sent To Your Email :</p>
    <p>Omnianeil9@Gmail.Com</p>
</div>
@endsection

@section('scripts')
    <script>
        setTimeout(function() {window.location.href = "{{ route('verification.code') }}";}, 1000);
    </script>
@endsection
