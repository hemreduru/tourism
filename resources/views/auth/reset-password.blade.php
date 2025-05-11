@extends('adminlte::auth.auth-page', ['auth_type' => 'password_reset'])

@section('auth_header', __('Reset Password'))

@section('auth_body')
    <form action="{{ route('password.store') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email', $request->email) }}" required autofocus>
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
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm Password') }}" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">{{ __('Reset Password') }}</button>
    </form>
@endsection

@section('auth_footer')
    <a href="{{ route('login') }}">{{ __('Login') }}</a>
@endsection
