@extends('layout.general')

@section('content')
<div class="full-container">
    <div class="brand-logo-large">Automize</div>
    <div class="powered-by">Powered By Des</div>
</div>
@endsection

@section('scripts')
    <script>
        setTimeout(function() {window.location.href = "{{ route('authentication') }}";}, 1000);
    </script>
@endsection
