@extends('layouts.app')

@section('title', __('testimonials.add_new_testimonial'))

@section('content_header')
    <h1>{{ __('testimonials.add_new_testimonial') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">@lang('testimonials.testimonial_details')</h3>
                </div>
                <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name_en">@lang('testimonials.name_en')</label>
                            <input type="text" name="name_en" class="form-control @error('name_en') is-invalid @enderror" value="{{ old('name_en') }}" required>
                            @error('name_en')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="name_tr">@lang('testimonials.name_tr')</label>
                            <input type="text" name="name_tr" class="form-control @error('name_tr') is-invalid @enderror" value="{{ old('name_tr') }}" required>
                            @error('name_tr')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="name_nl">@lang('testimonials.name_nl')</label>
                            <input type="text" name="name_nl" class="form-control @error('name_nl') is-invalid @enderror" value="{{ old('name_nl') }}" required>
                            @error('name_nl')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="title_en">@lang('testimonials.title_en')</label>
                            <input type="text" name="title_en" class="form-control @error('title_en') is-invalid @enderror" value="{{ old('title_en') }}">
                            @error('title_en')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="title_tr">@lang('testimonials.title_tr')</label>
                            <input type="text" name="title_tr" class="form-control @error('title_tr') is-invalid @enderror" value="{{ old('title_tr') }}">
                            @error('title_tr')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="title_nl">@lang('testimonials.title_nl')</label>
                            <input type="text" name="title_nl" class="form-control @error('title_nl') is-invalid @enderror" value="{{ old('title_nl') }}">
                            @error('title_nl')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                        </div>

                        <div class="form-group">
                            <label>@lang('testimonials.image')</label>
                            <div class="mb-2"><img id="imgPreview" src="#" class="img-thumbnail d-none" style="max-height:150px;"></div>
                            <input type="file" name="image" class="form-control-file custom-image-input @error('image') is-invalid @enderror" data-preview="imgPreview" accept="image/*">
                            @error('image')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="comment_en">@lang('testimonials.comment_en')</label>
                            <textarea name="comment_en" class="form-control summernote">{{ old('comment_en') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="comment_tr">@lang('testimonials.comment_tr')</label>
                            <textarea name="comment_tr" class="form-control summernote">{{ old('comment_tr') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="comment_nl">@lang('testimonials.comment_nl')</label>
                            <textarea name="comment_nl" class="form-control summernote">{{ old('comment_nl') }}</textarea>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="is_active" class="custom-control-input" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">@lang('common.active')</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">@lang('common.create')</button>
                        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-default">@lang('common.cancel')</a>
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
