@extends('layouts.app')

@section('title', __('services.add_new_service'))

@section('content_header')
    <h1>{{ __('services.add_new_service') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">@lang('services.service_details')</h3>
                </div>
                <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="service_name_en">@lang('services.service_name_en')</label>
                            <input type="text" name="service_name_en" id="service_name_en" class="form-control @error('service_name_en') is-invalid @enderror" value="{{ old('service_name_en') }}" required>
                            @error('service_name_en')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="service_name_tr">@lang('services.service_name_tr')</label>
                            <input type="text" name="service_name_tr" id="service_name_tr" class="form-control @error('service_name_tr') is-invalid @enderror" value="{{ old('service_name_tr') }}" required>
                            @error('service_name_tr')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="service_name_nl">@lang('services.service_name_nl')</label>
                            <input type="text" name="service_name_nl" id="service_name_nl" class="form-control @error('service_name_nl') is-invalid @enderror" value="{{ old('service_name_nl') }}" required>
                            @error('service_name_nl')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>@lang('services.image')</label>
                            <div class="mb-2">
                                <img id="serviceImagePreview" src="#" class="img-thumbnail d-none" style="max-height:150px;">
                            </div>
                            <input type="file" name="image" class="form-control-file custom-image-input @error('image') is-invalid @enderror" data-preview="serviceImagePreview" accept="image/*">
                            @error('image')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="short_description_en">@lang('services.short_description_en')</label>
                            <textarea name="short_description_en" id="short_description_en" class="form-control summernote @error('short_description_en') is-invalid @enderror" rows="3">{{ old('short_description_en') }}</textarea>
                            @error('short_description_en')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="short_description_tr">@lang('services.short_description_tr')</label>
                            <textarea name="short_description_tr" id="short_description_tr" class="form-control summernote @error('short_description_tr') is-invalid @enderror" rows="3">{{ old('short_description_tr') }}</textarea>
                            @error('short_description_tr')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="short_description_nl">@lang('services.short_description_nl')</label>
                            <textarea name="short_description_nl" id="short_description_nl" class="form-control summernote @error('short_description_nl') is-invalid @enderror" rows="3">{{ old('short_description_nl') }}</textarea>
                            @error('short_description_nl')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content_en">@lang('services.content_en')</label>
                            <textarea name="content_en" id="content_en" class="form-control summernote @error('content_en') is-invalid @enderror">{{ old('content_en') }}</textarea>
                            @error('content_en')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="content_tr">@lang('services.content_tr')</label>
                            <textarea name="content_tr" id="content_tr" class="form-control summernote @error('content_tr') is-invalid @enderror">{{ old('content_tr') }}</textarea>
                            @error('content_tr')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="content_nl">@lang('services.content_nl')</label>
                            <textarea name="content_nl" id="content_nl" class="form-control summernote @error('content_nl') is-invalid @enderror">{{ old('content_nl') }}</textarea>
                            @error('content_nl')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="link">@lang('common.link')</label>
                            <input type="text" name="link" id="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link') }}">
                            @error('link')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="order">@lang('common.order')</label>
                            <input type="number" class="form-control" name="order" id="order" value="{{ old('order',0) }}">
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="is_active" class="custom-control-input" id="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">@lang('common.active')</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">@lang('common.create')</button>
                        <a href="{{ route('admin.services.index') }}" class="btn btn-default">@lang('common.cancel')</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.custom-image-input').forEach(function (input) {
            input.addEventListener('change', function () {
                const preview = document.getElementById(this.dataset.preview);
                if (this.files && this.files[0]) {
                    preview.src = URL.createObjectURL(this.files[0]);
                    preview.classList.remove('d-none');
                }
            });
        });
    });
</script>
@endpush
