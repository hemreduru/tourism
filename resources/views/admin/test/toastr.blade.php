@extends('layouts.app')

@section('title', 'Toastr Test')

@section('content_header')
    <h1>{{ __('Toastr Test') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Test Toastr Notifications') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('admin.test.toastr.success') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="success-message">{{ __('Success Message') }}</label>
                                    <input type="text" name="message" id="success-message" class="form-control" value="This is a success message">
                                </div>
                                <button type="submit" class="btn btn-success">{{ __('Test Success Toast') }}</button>
                            </form>
                            <hr>

                            <form action="{{ route('admin.test.toastr.error') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="error-message">{{ __('Error Message') }}</label>
                                    <input type="text" name="message" id="error-message" class="form-control" value="This is an error message">
                                </div>
                                <button type="submit" class="btn btn-danger">{{ __('Test Error Toast') }}</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('admin.test.toastr.info') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="info-message">{{ __('Info Message') }}</label>
                                    <input type="text" name="message" id="info-message" class="form-control" value="This is an info message">
                                </div>
                                <button type="submit" class="btn btn-info">{{ __('Test Info Toast') }}</button>
                            </form>
                            <hr>

                            <form action="{{ route('admin.test.toastr.warning') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="warning-message">{{ __('Warning Message') }}</label>
                                    <input type="text" name="message" id="warning-message" class="form-control" value="This is a warning message">
                                </div>
                                <button type="submit" class="btn btn-warning">{{ __('Test Warning Toast') }}</button>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('admin.test.toastr.validation') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-secondary">{{ __('Test Validation Errors') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .card form {
            margin-bottom: 20px;
        }
    </style>
@stop

