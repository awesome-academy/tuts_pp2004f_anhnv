<!DOCTYPE html>
<html lang="{{ str_replace('-', '_', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ticket App @yield('title')</title>
  @include('admin_default.layout.styles')
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    @include('admin_default.layout.header')
    @include('admin_default.layout.sidenav')
      <div class="content-wrapper">
        <section class="content">
            @section('content')
                <h3>Welcome to Ticket Manager Dashboard</h3>
            @show
        </section>
      </div>
  </div>
  @include('admin_default.layout.control_sidebar')

  @include('admin_default.layout.scripts')
  @stack('js')

  @if(Session::has('message'))
    @include('admin_default.partials.message')
  @endif
</body>
</html>