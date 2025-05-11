@extends('adminlte::auth.auth-page', ['auth_type' => 'password_reset'])

@section('auth_header', __('Reset Password'))

@section('auth_body')
    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="{{ __('E-Mail Address') }}" required autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">{{ __('Send Password Reset Link') }}</button>
    </form>
@endsection

@section('auth_footer')
    <a href="{{ route('login') }}">{{ __('Login') }}</a>
@endsection
