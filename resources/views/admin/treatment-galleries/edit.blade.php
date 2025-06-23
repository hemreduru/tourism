@extends('layouts.app')

@section('title', __('gallery.edit_gallery'))

@section('content_header')
    <h1>{{ __('gallery.edit_gallery') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">@lang('gallery.gallery_details')</h3>
            </div>
            <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label>@lang('gallery.treatment_type_en')</label>
                        <input type="text" name="treatment_type_en" class="form-control @error('treatment_type_en') is-invalid @enderror" value="{{ old('treatment_type_en', $gallery->treatment_type_en) }}" required>
                        @error('treatment_type_en')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    <div class="form-group">
                        <label>@lang('gallery.treatment_type_tr')</label>
                        <input type="text" name="treatment_type_tr" class="form-control @error('treatment_type_tr') is-invalid @enderror" value="{{ old('treatment_type_tr', $gallery->treatment_type_tr) }}" required>
                        @error('treatment_type_tr')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    <div class="form-group">
                        <label>@lang('gallery.treatment_type_nl')</label>
                        <input type="text" name="treatment_type_nl" class="form-control @error('treatment_type_nl') is-invalid @enderror" value="{{ old('treatment_type_nl', $gallery->treatment_type_nl) }}" required>
                        @error('treatment_type_nl')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    <div class="form-group">
                        <label>@lang('gallery.before_image')</label>
                        <div class="mb-2"><img id="beforePreview" src="{{ $gallery->before_image_path ? asset($gallery->before_image_path) : '#' }}" class="img-thumbnail {{ $gallery->before_image_path ? '' : 'd-none' }}" style="max-height:150px;"></div>
                        <input type="file" name="before_image" class="form-control-file custom-image-input @error('before_image') is-invalid @enderror" data-preview="beforePreview" accept="image/*">
                        @error('before_image')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    <div class="form-group">
                        <label>@lang('gallery.after_image')</label>
                        <div class="mb-2"><img id="afterPreview" src="{{ $gallery->after_image_path ? asset($gallery->after_image_path) : '#' }}" class="img-thumbnail {{ $gallery->after_image_path ? '' : 'd-none' }}" style="max-height:150px;"></div>
                        <input type="file" name="after_image" class="form-control-file custom-image-input @error('after_image') is-invalid @enderror" data-preview="afterPreview" accept="image/*">
                        @error('after_image')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    <div class="form-group">
                        <label>@lang('gallery.order')</label>
                        <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', $gallery->order) }}">
                        @error('order')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="is_active" class="custom-control-input" id="is_active" value="1" {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_active">@lang('common.active')</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">@lang('common.update')</button>
                    <a href="{{ route('admin.galleries.index') }}" class="btn btn-default">@lang('common.cancel')</a>
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
