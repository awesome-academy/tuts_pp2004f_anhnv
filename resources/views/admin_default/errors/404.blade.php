@extends('admin_default')

@section('title', '| Not Found')

@section('content')
<div class="admin_404">
    <figure>
        <img src="{{ asset('_admin/img/404error.jpeg') }}" alt="404 Not Found">
        <h1><figcaption class="text-center">404 Not Found</figcaption></h1>
    </figure>
</div>

<style>
    .admin_404 {
        display: flex;
        width: 100%;
        height: 100vh;
        justify-content: center;
        align-items: center;
        transform: translatey(-20vh);
    }
</style>
@endsection