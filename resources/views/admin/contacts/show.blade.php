@extends('layouts.app')

@section('title', __('contacts.contact_details'))

@section('content_header')
    <h1>{{ __('contacts.contact_details') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">@lang('contacts.contact_information')</h3>
                    <div class="card-tools">
                        @if(auth()->user()->hasPermission('contacts.edit'))
                            <a href="{{ route('admin.contacts.edit', $contact->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-edit"></i> @lang('common.edit')
                            </a>
                        @endif
                        <a href="{{ route('admin.contacts.index') }}" class="btn btn-default btn-sm">
                            <i class="fas fa-list"></i> @lang('contacts.all_contacts')
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title">@lang('common.general_information')</h5>
                                </div>
                                <div class="card-body">
                                    <dl class="row">
                                        <dt class="col-sm-4">@lang('contacts.name')</dt>
                                        <dd class="col-sm-8">{{ $contact->name }}</dd>

                                        <dt class="col-sm-4">@lang('contacts.email')</dt>
                                        <dd class="col-sm-8"><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></dd>

                                        <dt class="col-sm-4">@lang('contacts.phone')</dt>
                                        <dd class="col-sm-8">{{ $contact->phone ?: '-' }}</dd>

                                        <dt class="col-sm-4">@lang('contacts.date_time')</dt>
                                        <dd class="col-sm-8">{{ $contact->date_time }}</dd>

                                        <dt class="col-sm-4">@lang('contacts.language')</dt>
                                        <dd class="col-sm-8">
                                            @if($contact->language == 'en')
                                                <span class="badge badge-info">English</span>
                                            @elseif($contact->language == 'tr')
                                                <span class="badge badge-info">Türkçe</span>
                                            @elseif($contact->language == 'nl')
                                                <span class="badge badge-info">Nederlands</span>
                                            @endif
                                        </dd>

                                        <dt class="col-sm-4">@lang('contacts.status')</dt>
                                        <dd class="col-sm-8">
                                            @if($contact->status)
                                                <span class="badge" style="background-color: {{ $contact->status->color }}; color: #fff;">
                                                    {{ $contact->status['name_' . app()->getLocale()] }}
                                                </span>
                                            @else
                                                <span class="badge badge-secondary">@lang('common.not_set')</span>
                                            @endif
                                        </dd>

                                        <dt class="col-sm-4">@lang('contacts.is_read')</dt>
                                        <dd class="col-sm-8">
                                            @if($contact->is_read)
                                                <span class="badge badge-success">@lang('common.yes')</span>
                                            @else
                                                <span class="badge badge-danger">@lang('common.no')</span>
                                            @endif
                                        </dd>

                                        <dt class="col-sm-4">@lang('contacts.is_responded')</dt>
                                        <dd class="col-sm-8">
                                            @if($contact->is_responded)
                                                <span class="badge badge-success">@lang('common.yes')</span>
                                            @else
                                                <span class="badge badge-danger">@lang('common.no')</span>
                                            @endif
                                        </dd>

                                        <dt class="col-sm-4">@lang('common.created_at')</dt>
                                        <dd class="col-sm-8">{{ $contact->created_at->format('d.m.Y H:i:s') }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="nav-tabs-custom mt-4">
                        <ul class="nav nav-tabs" id="language-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="en-tab" data-toggle="tab" href="#en" role="tab" aria-controls="en" aria-selected="true">English</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tr-tab" data-toggle="tab" href="#tr" role="tab" aria-controls="tr" aria-selected="false">Türkçe</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="nl-tab" data-toggle="tab" href="#nl" role="tab" aria-controls="nl" aria-selected="false">Nederlands</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="language-contents">
                            <div class="tab-pane fade show active" id="en" role="tabpanel" aria-labelledby="en-tab">
                                <div class="form-group">
                                    <label>@lang('contacts.message_en')</label>
                                    <div class="p-2 bg-light">
                                        {!! nl2br(e($contact->message_en)) ?: '<em>' . __('common.not_provided') . '</em>' !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tr" role="tabpanel" aria-labelledby="tr-tab">
                                <div class="form-group">
                                    <label>@lang('contacts.message_tr')</label>
                                    <div class="p-2 bg-light">
                                        {!! nl2br(e($contact->message_tr)) ?: '<em>' . __('common.not_provided') . '</em>' !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nl" role="tabpanel" aria-labelledby="nl-tab">
                                <div class="form-group">
                                    <label>@lang('contacts.message_nl')</label>
                                    <div class="p-2 bg-light">
                                        {!! nl2br(e($contact->message_nl)) ?: '<em>' . __('common.not_provided') . '</em>' !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
