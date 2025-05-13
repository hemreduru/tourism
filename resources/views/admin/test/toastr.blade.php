@extends('layouts.app')

@section('title', 'Toastr Test')
@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('Toastr Test') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.dashboard.title') }}</a></li>
                <li class="breadcrumb-item active">{{ __('Toastr Test') }}</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    @if(auth()->user()->hasPermission('test.test'))
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Test Toastr Notifications') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Success & Error Tests') }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="success-message">{{ __('Success Message') }}</label>
                                        <div class="input-group">
                                            <input type="text" id="success-message" class="form-control" value="This is a success message">
                                            <div class="input-group-append">
                                                <button type="button" onclick="testSuccess()" class="btn btn-success">{{ __('Test Success') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="error-message">{{ __('Error Message') }}</label>
                                        <div class="input-group">
                                            <input type="text" id="error-message" class="form-control" value="This is an error message">
                                            <div class="input-group-append">
                                                <button type="button" onclick="testError()" class="btn btn-danger">{{ __('Test Error') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Info & Warning Tests') }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="info-message">{{ __('Info Message') }}</label>
                                        <div class="input-group">
                                            <input type="text" id="info-message" class="form-control" value="This is an info message">
                                            <div class="input-group-append">
                                                <button type="button" onclick="testInfo()" class="btn btn-info">{{ __('Test Info') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="warning-message">{{ __('Warning Message') }}</label>
                                        <div class="input-group">
                                            <input type="text" id="warning-message" class="form-control" value="This is a warning message">
                                            <div class="input-group-append">
                                                <button type="button" onclick="testWarning()" class="btn btn-warning">{{ __('Test Warning') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger">
                {{ __('You do not have permission to access this page.') }}
            </div>
        </div>
    </div>
    @endif
@stop

@section('js')
@parent
<script>
document.addEventListener('DOMContentLoaded', function() {
    window.testSuccess = function() {
        const message = document.getElementById('success-message').value;
        toast.success(message);
    }

    window.testError = function() {
        const message = document.getElementById('error-message').value;
        toast.error(message);
    }

    window.testInfo = function() {
        const message = document.getElementById('info-message').value;
        toast.info(message);
    }

    window.testWarning = function() {
        const message = document.getElementById('warning-message').value;
        toast.warning(message);
    }
});
</script>
@stop

