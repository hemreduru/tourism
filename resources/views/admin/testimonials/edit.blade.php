@extends('layouts.app')

@section('title', __('testimonials.edit_testimonial'))

@section('content_header')
    <h1>{{ __('testimonials.edit_testimonial') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header"><h3 class="card-title">@lang('testimonials.testimonial_details')</h3></div>
                <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="card-body">
                        <div class="form-group"><label for="name_en">@lang('testimonials.name_en')</label>
                            <input type="text" name="name_en" class="form-control" value="{{ old('name_en', $testimonial->name_en) }}" required></div>
                        <div class="form-group"><label for="name_tr">@lang('testimonials.name_tr')</label>
                            <input type="text" name="name_tr" class="form-control" value="{{ old('name_tr', $testimonial->name_tr) }}" required></div>
                        <div class="form-group"><label for="name_nl">@lang('testimonials.name_nl')</label>
                            <input type="text" name="name_nl" class="form-control" value="{{ old('name_nl', $testimonial->name_nl) }}" required></div>
                        <div class="form-group"><label for="title_en">@lang('testimonials.title_en')</label>
                            <input type="text" name="title_en" class="form-control" value="{{ old('title_en', $testimonial->title_en) }}"></div>
                        <div class="form-group"><label for="title_tr">@lang('testimonials.title_tr')</label>
                            <input type="text" name="title_tr" class="form-control" value="{{ old('title_tr', $testimonial->title_tr) }}"></div>
                        <div class="form-group"><label for="title_nl">@lang('testimonials.title_nl')</label>
                            <input type="text" name="title_nl" class="form-control" value="{{ old('title_nl', $testimonial->title_nl) }}"></div>

                        <div class="form-group"><label>@lang('testimonials.image')</label>
                            @if($testimonial->image_path)
                                <div class="mb-2"><img src="/{{ $testimonial->image_path }}" alt="image" class="img-thumbnail" style="max-height:150px;"></div>
                            @endif
                            <input type="file" name="image" class="form-control-file" accept="image/*"></div>

                        <div class="form-group"><label for="comment_en">@lang('testimonials.comment_en')</label>
                            <textarea name="comment_en" id="comment_en" class="form-control summernote">{{ old('comment_en', $testimonial->comment_en) }}</textarea></div>
                        <div class="form-group"><label for="comment_tr">@lang('testimonials.comment_tr')</label>
                            <textarea name="comment_tr" id="comment_tr" class="form-control summernote">{{ old('comment_tr', $testimonial->comment_tr) }}</textarea></div>
                        <div class="form-group"><label for="comment_nl">@lang('testimonials.comment_nl')</label>
                            <textarea name="comment_nl" id="comment_nl" class="form-control summernote">{{ old('comment_nl', $testimonial->comment_nl) }}</textarea></div>

                        <div class="form-group"><div class="custom-control custom-switch">
                                <input type="checkbox" name="is_active" class="custom-control-input" id="is_active" value="1" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">@lang('common.active')</label>
                            </div></div>
                    </div>
                    <div class="card-footer"><button type="submit" class="btn btn-primary">@lang('common.update')</button>
                        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-default">@lang('common.cancel')</a></div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    $(function(){
        $('#comment_en, #comment_tr, #comment_nl').summernote({height:200});
    });
</script>
@endpush
