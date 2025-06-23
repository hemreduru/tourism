@extends('layouts.app')

@section('title', __('gallery.gallery_details'))

@section('content_header')
    <h1>{{ __('gallery.gallery_details') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">@lang('gallery.gallery_details')</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">@lang('common.general_information')</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>@lang('common.id'):</strong> {{ $gallery->id }}</p>
                                    <p><strong>@lang('gallery.order'):</strong> {{ $gallery->order }}</p>
                                    <p><strong>@lang('common.status'):</strong>
                                        @if($gallery->is_active)
                                            <span class="badge badge-success">@lang('common.active')</span>
                                        @else
                                            <span class="badge badge-danger">@lang('common.inactive')</span>
                                        @endif
                                    </p>
                                    <p><strong>@lang('common.created_at'):</strong> {{ $gallery->created_at->format('d.m.Y H:i:s') }}</p>
                                    <p><strong>@lang('common.updated_at'):</strong> {{ $gallery->updated_at->format('d.m.Y H:i:s') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach(['en', 'tr', 'nl'] as $locale)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-info card-outline mb-4">
                                    <div class="card-header">
                                        <h5 class="card-title">@lang('gallery.treatment_type_' . $locale) ({{ strtoupper($locale) }})</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $gallery->{'treatment_type_' . $locale} }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-secondary card-outline mb-4">
                                <div class="card-header"><h5 class="card-title">@lang('gallery.before_image')</h5></div>
                                <div class="card-body text-center">
                                    @if($gallery->before_image_path)
                                        <img src="/{{ $gallery->before_image_path }}" alt="@lang('gallery.before_image')" class="img-fluid rounded shadow-sm" style="max-height:300px;">
                                    @else
                                        <em>@lang('common.not_provided')</em>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-secondary card-outline mb-4">
                                <div class="card-header"><h5 class="card-title">@lang('gallery.after_image')</h5></div>
                                <div class="card-body text-center">
                                    @if($gallery->after_image_path)
                                        <img src="/{{ $gallery->after_image_path }}" alt="@lang('gallery.after_image')" class="img-fluid rounded shadow-sm" style="max-height:300px;">
                                    @else
                                        <em>@lang('common.not_provided')</em>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('admin.galleries.index') }}" class="btn btn-default">@lang('common.back_to_list')</a>
                            @can('galleries.edit')
                                <a href="{{ route('admin.galleries.edit', $gallery->id) }}" class="btn btn-info">@lang('common.edit')</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
