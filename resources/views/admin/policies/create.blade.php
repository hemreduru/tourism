@extends('layouts.app')

@section('title', __('policies.add_new_policy'))

@section('content_header')
    <h1>{{ __('policies.add_new_policy') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">{{ __('policies.policy_information') }}</h3>
            </div>
            <form action="{{ route('admin.policies.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="type">{{ __('policies.type') }}</label>
                        <select id="type" name="type" class="form-control @error('type') is-invalid @enderror">
                            <option value="">{{ __('common.select') }}</option>
                            <option value="privacy" {{ old('type')=='privacy' ? 'selected':'' }}>{{ __('policies.privacy') }}</option>
                            <option value="terms" {{ old('type')=='terms' ? 'selected':'' }}>{{ __('policies.terms') }}</option>
                            <option value="gdpr" {{ old('type')=='gdpr' ? 'selected':'' }}>{{ __('policies.gdpr') }}</option>
                        </select>
                        @error('type')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="title_en">{{ __('policies.title_en') }}</label>
                        <input type="text" class="form-control @error('title_en') is-invalid @enderror" id="title_en" name="title_en" value="{{ old('title_en') }}">
                        @error('title_en')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="title_tr">{{ __('policies.title_tr') }}</label>
                        <input type="text" class="form-control @error('title_tr') is-invalid @enderror" id="title_tr" name="title_tr" value="{{ old('title_tr') }}">
                        @error('title_tr')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="title_nl">{{ __('policies.title_nl') }}</label>
                        <input type="text" class="form-control @error('title_nl') is-invalid @enderror" id="title_nl" name="title_nl" value="{{ old('title_nl') }}">
                        @error('title_nl')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="content_en">{{ __('policies.content_en') }}</label>
                        <textarea class="form-control summernote @error('content_en') is-invalid @enderror" id="content_en" name="content_en">{{ old('content_en') }}</textarea>
                        @error('content_en')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="content_tr">{{ __('policies.content_tr') }}</label>
                        <textarea class="form-control summernote @error('content_tr') is-invalid @enderror" id="content_tr" name="content_tr">{{ old('content_tr') }}</textarea>
                        @error('content_tr')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="content_nl">{{ __('policies.content_nl') }}</label>
                        <textarea class="form-control summernote @error('content_nl') is-invalid @enderror" id="content_nl" name="content_nl">{{ old('content_nl') }}</textarea>
                        @error('content_nl')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_active">{{ __('policies.is_active') }}</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">{{ __('common.save') }}</button>
                    <a href="{{ route('admin.policies.index') }}" class="btn btn-default">{{ __('common.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
