@extends('layouts.app')

@section('title', __('about_us.about_us_details'))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('about_us.about_us_details') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.dashboard.title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.about_us.index') }}">{{ __('about_us.about_us') }}</a></li>
                <li class="breadcrumb-item active">{{ $aboutUs->title_en }}</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('about_us.about_us_information') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('about_us.general_information') }}</h3>
                                </div>
                                <div class="card-body">
                                    <dl class="row">
                                        <dt class="col-sm-4">{{ __('about_us.id') }}:</dt>
                                        <dd class="col-sm-8">{{ $aboutUs->id }}</dd>

                                        <dt class="col-sm-4">{{ __('about_us.is_active') }}:</dt>
                                        <dd class="col-sm-8">
                                            @if($aboutUs->is_active)
                                                <span class="badge badge-success">{{ __('common.active') }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ __('common.inactive') }}</span>
                                            @endif
                                        </dd>

                                        <dt class="col-sm-4">{{ __('common.created_at') }}:</dt>
                                        <dd class="col-sm-8">{{ $aboutUs->created_at->format('d M Y, H:i') }}</dd>

                                        <dt class="col-sm-4">{{ __('common.updated_at') }}:</dt>
                                        <dd class="col-sm-8">{{ $aboutUs->updated_at->format('d M Y, H:i') }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            {{-- English Card --}}
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('about_us.title_en') }} (English)</h3>
                                </div>
                                <div class="card-body">
                                    <h4>{{ $aboutUs->title_en }}</h4>
                                    <hr>
                                    <div>{!! $aboutUs->content_en !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            {{-- Turkish Card --}}
                            <div class="card card-info card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('about_us.title_tr') }} (Türkçe)</h3>
                                </div>
                                <div class="card-body">
                                    <h4>{{ $aboutUs->title_tr }}</h4>
                                    <hr>
                                    <div>{!! $aboutUs->content_tr !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            {{-- Dutch Card --}}
                            <div class="card card-success card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('about_us.title_nl') }} (Nederlands)</h3>
                                </div>
                                <div class="card-body">
                                    <h4>{{ $aboutUs->title_nl }}</h4>
                                    <hr>
                                    <div>{!! $aboutUs->content_nl !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    @if(auth()->user()->hasPermission('about_us.edit'))
                    <a href="{{ route('admin.about_us.edit', $aboutUs->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit mr-1"></i> {{ __('common.edit') }}
                    </a>
                    @endif
                    <a href="{{ route('admin.about_us.index') }}" class="btn btn-default">
                        <i class="fas fa-arrow-left mr-1"></i> {{ __('common.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
