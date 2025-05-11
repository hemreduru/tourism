@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@section('auth_header', __('Register'))

@section('auth_body')
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
            <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}" required autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="{{ __('E-Mail Address') }}" required>
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
        <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>
    </form>
@endsection

@section('auth_footer')
    <a href="{{ route('login') }}">{{ __('I already have a membership') }}</a>
@endsection
