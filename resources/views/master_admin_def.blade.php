<!DOCTYPE html>
<html lang="{{ str_replace('-', '_', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel News @yield('title')</title>
    @include('admin_default.layouts.head')
</head>
<body class="hold-transition skin-yellow sidebar-mini">
    <div class="wrapper">
        @include('admin_default.layouts.header')
        @include('admin_default.layouts.sidenav')

        <div class="content-wrapper">
            <section class="content">
                @section('content')
                <h2>Welcome to Laravel News Dashboard</h2>
                @show
            </section>
        </div>

        @include('admin_default.layouts.control_sidebar')
    </div>
@include('admin_default.layouts.scripts')

@if(session()->has('message'))
    @include('admin_default.partials.message')
@endif
</body>
</html>
