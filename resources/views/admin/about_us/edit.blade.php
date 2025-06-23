@extends('layouts.app')

@section('title', __('about_us.edit'))

@section('content_header')
    <h1>{{ __('about_us.edit') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('about_us.about_us_information') }}</h3>
                </div>
                <form action="{{ route('admin.about_us.update', $aboutUs->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title_en">{{ __('about_us.title_en') }}</label>
                            <input type="text" class="form-control @error('title_en') is-invalid @enderror"
                                id="title_en" name="title_en" value="{{ old('title_en', $aboutUs->title_en) }}" placeholder="{{ __('about_us.title_en') }}">
                            @error('title_en')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="title_tr">{{ __('about_us.title_tr') }}</label>
                            <input type="text" class="form-control @error('title_tr') is-invalid @enderror"
                                id="title_tr" name="title_tr" value="{{ old('title_tr', $aboutUs->title_tr) }}" placeholder="{{ __('about_us.title_tr') }}">
                            @error('title_tr')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="title_nl">{{ __('about_us.title_nl') }}</label>
                            <input type="text" class="form-control @error('title_nl') is-invalid @enderror"
                                id="title_nl" name="title_nl" value="{{ old('title_nl', $aboutUs->title_nl) }}" placeholder="{{ __('about_us.title_nl') }}">
                            @error('title_nl')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content_en">{{ __('about_us.content_en') }}</label>
                            <textarea class="form-control summernote @error('content_en') is-invalid @enderror" id="content_en" name="content_en" rows="5" placeholder="{{ __('about_us.content_en') }}">{{ old('content_en', $aboutUs->content_en) }}</textarea>
                            @error('content_en')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content_tr">{{ __('about_us.content_tr') }}</label>
                            <textarea class="form-control summernote @error('content_tr') is-invalid @enderror" id="content_tr" name="content_tr" rows="5" placeholder="{{ __('about_us.content_tr') }}">{{ old('content_tr', $aboutUs->content_tr) }}</textarea>
                            @error('content_tr')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content_nl">{{ __('about_us.content_nl') }}</label>
                            <textarea class="form-control summernote @error('content_nl') is-invalid @enderror" id="content_nl" name="content_nl" rows="5" placeholder="{{ __('about_us.content_nl') }}">{{ old('content_nl', $aboutUs->content_nl) }}</textarea>
                            @error('content_nl')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="hidden" name="is_active" value="0"> {{-- Hidden field to ensure 0 is sent if checkbox is unchecked --}}
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', $aboutUs->is_active) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">{{ __('about_us.is_active') }}</label>
                            </div>
                            @error('is_active')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ __('common.update') }}</button>
                        <a href="{{ route('admin.about_us.index') }}" class="btn btn-default">{{ __('common.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
{{--    <script>
        $(function() {
            $('#content_en').summernote({
                height: 300
            });
            $('#content_tr').summernote({
                height: 300
            });
            $('#content_nl').summernote({
                height: 300
            });
        });
    </script>--}}
@stop
