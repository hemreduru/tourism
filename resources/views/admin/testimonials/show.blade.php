@extends('layouts.app')

@section('title', __('testimonials.testimonial'))

@section('content_header')
    <h1>{{ __('testimonials.testimonial') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card card-primary card-outline">
                <div class="card-header"><h3 class="card-title">{{ $testimonial->name_en }}</h3></div>
                <div class="card-body">
                    @if($testimonial->image_path)
                        <div class="text-center mb-4"><img src="/{{ $testimonial->image_path }}" alt="image" class="img-thumbnail" style="max-height:200px;"></div>
                    @endif
                    <h5 class="text-primary">English</h5>
                    <p><strong>@lang('testimonials.name_en'):</strong> {{ $testimonial->name_en }}</p>
                    <p><strong>@lang('testimonials.title_en'):</strong> {{ $testimonial->title_en }}</p>
                    <p><strong>@lang('testimonials.comment_en'):</strong><br> {!! $testimonial->comment_en !!}</p>

                    <hr>

                    <h5 class="text-primary">Türkçe</h5>
                    <p><strong>@lang('testimonials.name_tr'):</strong> {{ $testimonial->name_tr }}</p>
                    <p><strong>@lang('testimonials.title_tr'):</strong> {{ $testimonial->title_tr }}</p>
                    <p><strong>@lang('testimonials.comment_tr'):</strong><br> {!! $testimonial->comment_tr !!}</p>

                    <hr>

                    <h5 class="text-primary">Nederlands</h5>
                    <p><strong>@lang('testimonials.name_nl'):</strong> {{ $testimonial->name_nl }}</p>
                    <p><strong>@lang('testimonials.title_nl'):</strong> {{ $testimonial->title_nl }}</p>
                    <p><strong>@lang('testimonials.comment_nl'):</strong><br> {!! $testimonial->comment_nl !!}</p>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-default">@lang('common.back')</a>
                </div>
            </div>
        </div>
    </div>
@endsection
