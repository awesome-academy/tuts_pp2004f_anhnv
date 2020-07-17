@extends('master_admin_auth')

@section('title', '| Admin Login')

@section('body-class', 'hold-transition login-page')

@section('content')
<div class="custom-login-box">
    <h4 class="text-center">Welcome to Admin system</h4>
    <div class="login-logo">
        <a href="{{ url('/') }}" style="color: #286db5">Laravel <b>News</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <h4 class="login-box-msg">Sign in to start your session</h4>
        @error('permission')
            @section('error')
                {{ $errors->first('permission') }}
            @endsection
            @include('admin_default.partials.error')
        @enderror
        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                <i class="fa fa-envelope-o form-control-feedback"></i>
                @error('email')
                <div class="help-block">
                    {{ $errors->first('email') }}
                </div>
                @enderror
            </div>
            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                <i class="fa fa-lock form-control-feedback"></i>
                @error('password')
                <div class="help-block">
                    {{ $errors->first('password') }}
                </div>
                @enderror
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" id="remember" name="remember"> Remember Me
                        </label>
                    </div>
                </div>
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-lg btn-block btn-flat">Sign In</button>
                </div>
            </div>
        </form>

        <div>
            <a href="#"><i class="fa fa-bell-o"></i> I forgot my password</a><br>
            <a href="register.html" class="text-center"><i class="fa fa-user-plus"></i> Register a new membership</a>
        </div>

    </div>
    <!-- /.login-box-body -->
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('vendor/iCheck/square/blue.css') }}">
<style>
    body {
        font-size: 16px;
    }

    .custom-login-box {
        width: 480px;
        margin: 8% auto;
    }

    .login-box-body {
        box-shadow: 0 5px 5px rgba(0, 0, 0, .3);
    }

    form+div {
        margin-top: 20px;
    }

    [class*=icheckbox_square] {
        margin-right: 10px;
    }

    a>i {
        margin-right: 8px;
    }

</style>
@endpush

@push('js')
<script src="{{ asset('vendor/iCheck/icheck.min.js') }}"></script>
<script>
    $(function() {
        $('input[type=checkbox]').iCheck({
            checkboxClass: 'icheckbox_square-blue'
            , radioClass: 'iradio_square-blue'
            , increaseArea: '20%' /* optional */
        });
    });

</script>
@endpush
