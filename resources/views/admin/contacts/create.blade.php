@extends('layouts.app')

@section('title', __('contacts.add_new_contact'))

@section('content_header')
    <h1>{{ __('contacts.add_new_contact') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">@lang('contacts.contact_details')</h3>
                </div>
                <form action="{{ route('admin.contacts.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">@lang('contacts.name')</label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">@lang('contacts.email')</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">@lang('contacts.phone')</label>
                                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="language">@lang('contacts.language')</label>
                                    <select name="language" id="language" class="form-control @error('language') is-invalid @enderror" required>
                                        <option value="en" {{ old('language') == 'en' ? 'selected' : '' }}>English</option>
                                        <option value="tr" {{ old('language') == 'tr' ? 'selected' : '' }}>Türkçe</option>
                                        <option value="nl" {{ old('language') == 'nl' ? 'selected' : '' }}>Nederlands</option>
                                    </select>
                                    @error('language')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date">@lang('contacts.date')</label>
                                    <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}" required>
                                    @error('date')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="time_slot">@lang('contacts.time_slot')</label>
                                    <select name="time_slot" id="time_slot" class="form-control @error('time_slot') is-invalid @enderror" required>
                                        <option value="">@lang('common.select')</option>
                                        @foreach($timeSlots as $key => $value)
                                            <option value="{{ $key }}" {{ old('time_slot') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('time_slot')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status_id">@lang('contacts.status')</label>
                                    <select name="status_id" id="status_id" class="form-control @error('status_id') is-invalid @enderror" required>
                                        <option value="">@lang('common.select')</option>
                                        @foreach($statuses as $status)
                                            <option value="{{ $status->id }}" {{ old('status_id') == $status->id ? 'selected' : '' }}>
                                                <span class="badge" style="background-color: #f8f9fa; color: {{ $status->color }}; font-weight: bold;">
                                                    {{ $status['name_' . app()->getLocale()] }}
                                                </span>
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="is_read" class="custom-control-input" id="is_read" value="1" {{ old('is_read') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="is_read">@lang('contacts.is_read')</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="is_responded" class="custom-control-input" id="is_responded" value="1" {{ old('is_responded') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="is_responded">@lang('contacts.is_responded')</label>
                                            </div>
                                        </div>
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
                                        <label for="message_en">@lang('contacts.message_en')</label>
                                        <textarea name="message_en" id="message_en" class="form-control @error('message_en') is-invalid @enderror" rows="5">{{ old('message_en') }}</textarea>
                                        @error('message_en')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tr" role="tabpanel" aria-labelledby="tr-tab">
                                    <div class="form-group">
                                        <label for="message_tr">@lang('contacts.message_tr')</label>
                                        <textarea name="message_tr" id="message_tr" class="form-control @error('message_tr') is-invalid @enderror" rows="5">{{ old('message_tr') }}</textarea>
                                        @error('message_tr')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nl" role="tabpanel" aria-labelledby="nl-tab">
                                    <div class="form-group">
                                        <label for="message_nl">@lang('contacts.message_nl')</label>
                                        <textarea name="message_nl" id="message_nl" class="form-control @error('message_nl') is-invalid @enderror" rows="5">{{ old('message_nl') }}</textarea>
                                        @error('message_nl')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">@lang('common.create')</button>
                        <a href="{{ route('admin.contacts.index') }}" class="btn btn-default">@lang('common.cancel')</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
