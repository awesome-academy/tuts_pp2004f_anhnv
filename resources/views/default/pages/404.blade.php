@extends('master_admin_auth')

@section('title', '| Error 404')

@section('content')
<div class="error-page">
    <h2 class="headline text-yellow"> 404</h2>

    <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
        <p>
            We could not find the page you were looking for.
            Meanwhile, you may <a href="{{ url('/') }}">return to Home Page</a>.
        </p>
    </div>
</div>
@endsection

@push('styles')
<style>
    .error-page {
        padding-top: 16vh;
    }
    .error-content {
        transform: translateY(18px);
    }
</style>
@endpush