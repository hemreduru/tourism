@extends('layouts.app')

@section('title', __('services.edit_service'))

@section('content_header')
    <h1>{{ __('services.edit_service') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">@lang('services.service_details')</h3>
                </div>
                <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="company_name_en">@lang('services.company_name_en')</label>
                            <input type="text" name="company_name_en" id="company_name_en" class="form-control @error('company_name_en') is-invalid @enderror" value="{{ old('company_name_en', $service->company_name_en) }}" required>
                            @error('company_name_en')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="company_name_tr">@lang('services.company_name_tr')</label>
                            <input type="text" name="company_name_tr" id="company_name_tr" class="form-control @error('company_name_tr') is-invalid @enderror" value="{{ old('company_name_tr', $service->company_name_tr) }}" required>
                            @error('company_name_tr')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="company_name_nl">@lang('services.company_name_nl')</label>
                            <input type="text" name="company_name_nl" id="company_name_nl" class="form-control @error('company_name_nl') is-invalid @enderror" value="{{ old('company_name_nl', $service->company_name_nl) }}" required>
                            @error('company_name_nl')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">@lang('services.image')</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="image" id="image" class="custom-file-input @error('image') is-invalid @enderror">
                                    <label class="custom-file-label" for="image">@lang('common.choose_file')</label>
                                </div>
                            </div>
                            @if($service->image_path)
                                <div class="mt-2">
                                    <img src="/{{ $service->image_path }}" alt="Service Image" width="150">
                                </div>
                            @endif
                            @error('image')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="short_description_en">@lang('services.short_description_en')</label>
                            <textarea name="short_description_en" id="short_description_en" class="form-control summernote @error('short_description_en') is-invalid @enderror" rows="3">{{ old('short_description_en', $service->short_description_en) }}</textarea>
                            @error('short_description_en')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="short_description_tr">@lang('services.short_description_tr')</label>
                            <textarea name="short_description_tr" id="short_description_tr" class="form-control summernote @error('short_description_tr') is-invalid @enderror" rows="3">{{ old('short_description_tr', $service->short_description_tr) }}</textarea>
                            @error('short_description_tr')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="short_description_nl">@lang('services.short_description_nl')</label>
                            <textarea name="short_description_nl" id="short_description_nl" class="form-control summernote @error('short_description_nl') is-invalid @enderror" rows="3">{{ old('short_description_nl', $service->short_description_nl) }}</textarea>
                            @error('short_description_nl')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content_en">@lang('services.content_en')</label>
                            <textarea name="content_en" id="content_en" class="form-control summernote @error('content_en') is-invalid @enderror">{{ old('content_en', $service->content_en) }}</textarea>
                            @error('content_en')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="content_tr">@lang('services.content_tr')</label>
                            <textarea name="content_tr" id="content_tr" class="form-control summernote @error('content_tr') is-invalid @enderror">{{ old('content_tr', $service->content_tr) }}</textarea>
                            @error('content_tr')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="content_nl">@lang('services.content_nl')</label>
                            <textarea name="content_nl" id="content_nl" class="form-control summernote @error('content_nl') is-invalid @enderror">{{ old('content_nl', $service->content_nl) }}</textarea>
                            @error('content_nl')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="link">@lang('services.link')</label>
                            <input type="url" name="link" id="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link', $service->link) }}">
                            @error('link')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="is_active" class="custom-control-input" id="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">@lang('common.active')</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">@lang('common.update')</button>
                        <a href="{{ route('admin.services.index') }}" class="btn btn-default">@lang('common.cancel')</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
@endpush
