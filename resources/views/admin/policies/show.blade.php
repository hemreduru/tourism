@extends('layouts.app')

@section('title', __('policies.policy_information'))

@section('content_header')
    <h1>{{ __('policies.policy_information') }}</h1>
@stop

@section('content')
@php
    $languages = [
        'en' => 'English',
        'tr' => 'Türkçe',
        'nl' => 'Nederlands',
    ];
@endphp

<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">{{ __('policies.policy_information') }}</h3>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs" id="policyTab" role="tablist">
            @foreach($languages as $code => $label)
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $code }}" data-toggle="tab" href="#content-{{ $code }}" role="tab" aria-controls="content-{{ $code }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                        {{ strtoupper($code) }}
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="tab-content mt-3" id="policyTabContent">
            @foreach($languages as $code => $label)
                @php $titleField = 'title_' . $code; $contentField = 'content_' . $code; @endphp
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="content-{{ $code }}" role="tabpanel" aria-labelledby="tab-{{ $code }}">
                    <h4>{{ $policy->$titleField }}</h4>
                    {!! $policy->$contentField !!}
                </div>
            @endforeach
        </div>
    </div>
</div>
@stop
