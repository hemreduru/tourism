@extends('adminlte::auth.auth-page', ['auth_type' => 'verify'])

@section('auth_header', __('Verify Your Email Address'))

@section('auth_body')
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-primary btn-block">
            {{ __('Resend Verification Email') }}
        </button>
    </form>
    <form method="POST" action="{{ route('logout') }}" class="mt-2">
        @csrf
        <button type="submit" class="btn btn-link btn-block">
            {{ __('Log Out') }}
        </button>
    </form>
@endsection
