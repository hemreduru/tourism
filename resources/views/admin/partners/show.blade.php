@extends('layouts.app')

@section('title', __('partners.partner_details'))

@section('content_header')
    <h1>{{ __('partners.partner_details') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">@lang('partners.partner_details')</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title">@lang('about_us.general_information')</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>@lang('common.id'):</strong> {{ $partner->id }}</p>
                                    <p><strong>@lang('partners.website'):</strong>
                                        @if($partner->website)
                                            <a href="{{ $partner->website }}" target="_blank">{{ $partner->website }}</a>
                                        @else
                                            <em>@lang('common.not_provided')</em>
                                        @endif
                                    </p>
                                    <p><strong>@lang('partners.order'):</strong> {{ $partner->order }}</p>
                                    <p><strong>@lang('common.status'):</strong>
                                        @if($partner->is_active)
                                            <span class="badge badge-success">@lang('common.active')</span>
                                        @else
                                            <span class="badge badge-danger">@lang('common.inactive')</span>
                                        @endif
                                    </p>
                                    @if($partner->logo_path)
                                        <p><strong>@lang('partners.logo'):</strong></p>
                                        <img src="/{{ $partner->logo_path }}" alt="Partner Logo" width="200">
                                    @endif
                                    <p><strong>@lang('common.created_at'):</strong> {{ $partner->created_at->format('d.m.Y H:i:s') }}</p>
                                    <p><strong>@lang('common.updated_at'):</strong> {{ $partner->updated_at->format('d.m.Y H:i:s') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach(['en', 'tr', 'nl'] as $locale)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-info card-outline">
                                    <div class="card-header">
                                        <h5 class="card-title">@lang('partners.details_for_language') ({{ strtoupper($locale) }})</h5>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>@lang('partners.company_name'):</strong> {{ $partner->{'company_name_' . $locale} }}</p>
                                        <hr>
                                        <p><strong>@lang('partners.description'):</strong></p>
                                        <div>{!! $partner->{'description_' . $locale} !!}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('admin.partners.index') }}" class="btn btn-default">@lang('common.back_to_list')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
