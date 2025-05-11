@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_header', __('Confirm Password'))

@section('auth_body')
    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="{{ __('Password') }}" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">{{ __('Confirm') }}</button>
    </form>
@endsection
