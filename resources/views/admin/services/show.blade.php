@extends('layouts.app')

@section('title', __('services.service_details'))

@section('content_header')
    <h1>{{ __('services.service_details') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">@lang('services.service_details')</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title">@lang('about_us.general_information')</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>@lang('common.id'):</strong> {{ $service->id }}</p>
                                    <p><strong>@lang('services.link'):</strong> <a href="{{ $service->link }}" target="_blank">{{ $service->link }}</a></p>
                                    <p><strong>@lang('common.status'):</strong>
                                        @if($service->is_active)
                                            <span class="badge badge-success">@lang('common.active')</span>
                                        @else
                                            <span class="badge badge-danger">@lang('common.inactive')</span>
                                        @endif
                                    </p>
                                    @if($service->image_path)
                                        <p><strong>@lang('services.image'):</strong></p>
                                        <img src="/{{ $service->image_path }}" alt="Service Image" width="200">
                                    @endif
                                    <p><strong>@lang('common.created_at'):</strong> {{ $service->created_at->format('d.m.Y H:i:s') }}</p>
                                    <p><strong>@lang('common.updated_at'):</strong> {{ $service->updated_at->format('d.m.Y H:i:s') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach(['en', 'tr', 'nl'] as $locale)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-info card-outline">
                                    <div class="card-header">
                                        <h5 class="card-title">@lang('services.details_for_language') ({{ strtoupper($locale) }})</h5>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>@lang('services.company_name'):</strong> {{ $service->{'company_name_' . $locale} }}</p>
                                        <hr>
                                        <p><strong>@lang('services.short_description'):</strong></p>
                                        <div>{!! $service->{'short_description_' . $locale} !!}</div>
                                        <hr>
                                        <p><strong>@lang('services.content'):</strong></p>
                                        <div>{!! $service->{'content_' . $locale} !!}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('admin.services.index') }}" class="btn btn-default">@lang('common.back_to_list')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
