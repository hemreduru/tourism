@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_header', __('Login'))

@section('auth_body')
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="{{ __('E-Mail Address') }}" required autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="{{ __('Password') }}" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">{{ __('Remember Me') }}</label>
                </div>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
            </div>
        </div>
    </form>
@endsection

@section('auth_footer')
    <p class="my-0">
        <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
    </p>
@endsection
