@extends('layouts.app')

@section('title', __('common.edit'))

@section('content_header')
    <h1>{{ __('common.edit') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-header"><h3 class="card-title">{{ __('policies.policy_information') }}</h3></div>
            <form action="{{ route('admin.policies.update', $policy->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="type">{{ __('policies.type') }}</label>
                        <select id="type" name="type" class="form-control @error('type') is-invalid @enderror">
                            <option value="privacy" {{ $policy->type=='privacy' ? 'selected':'' }}>{{ __('policies.privacy') }}</option>
                            <option value="terms" {{ $policy->type=='terms' ? 'selected':'' }}>{{ __('policies.terms') }}</option>
                            <option value="gdpr" {{ $policy->type=='gdpr' ? 'selected':'' }}>{{ __('policies.gdpr') }}</option>
                        </select>
                        @error('type')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group"><label>{{ __('policies.title_en') }}</label><input type="text" name="title_en" value="{{ old('title_en',$policy->title_en) }}" class="form-control @error('title_en') is-invalid @enderror">@error('title_en')<span class="invalid-feedback">{{ $message }}</span>@enderror</div>
                    <div class="form-group"><label>{{ __('policies.title_tr') }}</label><input type="text" name="title_tr" value="{{ old('title_tr',$policy->title_tr) }}" class="form-control @error('title_tr') is-invalid @enderror">@error('title_tr')<span class="invalid-feedback">{{ $message }}</span>@enderror</div>
                    <div class="form-group"><label>{{ __('policies.title_nl') }}</label><input type="text" name="title_nl" value="{{ old('title_nl',$policy->title_nl) }}" class="form-control @error('title_nl') is-invalid @enderror">@error('title_nl')<span class="invalid-feedback">{{ $message }}</span>@enderror</div>

                    <div class="form-group"><label>{{ __('policies.content_en') }}</label><textarea name="content_en" class="form-control summernote @error('content_en') is-invalid @enderror">{{ old('content_en',$policy->content_en) }}</textarea>@error('content_en')<span class="invalid-feedback">{{ $message }}</span>@enderror</div>
                    <div class="form-group"><label>{{ __('policies.content_tr') }}</label><textarea name="content_tr" class="form-control summernote @error('content_tr') is-invalid @enderror">{{ old('content_tr',$policy->content_tr) }}</textarea>@error('content_tr')<span class="invalid-feedback">{{ $message }}</span>@enderror</div>
                    <div class="form-group"><label>{{ __('policies.content_nl') }}</label><textarea name="content_nl" class="form-control summernote @error('content_nl') is-invalid @enderror">{{ old('content_nl',$policy->content_nl) }}</textarea>@error('content_nl')<span class="invalid-feedback">{{ $message }}</span>@enderror</div>

                    <div class="form-group"><div class="custom-control custom-switch"><input type="hidden" name="is_active" value="0"><input type="checkbox" id="is_active" name="is_active" value="1" class="custom-control-input" {{ $policy->is_active ? 'checked':'' }}><label class="custom-control-label" for="is_active">{{ __('policies.is_active') }}</label></div></div>
                </div>
                <div class="card-footer"><button type="submit" class="btn btn-primary">{{ __('common.update') }}</button><a href="{{ route('admin.policies.index') }}" class="btn btn-default">{{ __('common.cancel') }}</a></div>
            </form>
        </div>
    </div>
</div>
@stop
