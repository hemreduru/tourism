@extends('theme.app')
@section('title', __('theme.contact'))
@section('content')
    @push('hero')
        @include('theme.partials.page-title', ['title' => __('theme.contact')])
    @endpush
<section class="py-6">
  <div class="container">
    {{--
        <h1 class="text-center mb-5">@lang('theme.contact')</h1>
    --}}
    <div class="row g-4">
      <div class="col-md-6">
        @include('theme.partials.contact-form')
      </div>
      <div class="col-md-6">
        @php
            $lat  = $setting->latitude  ?? 52.370216; // fallback Holland coords
            $lng  = $setting->longitude ?? 4.895168;
            $addr = $setting->{'address_'.app()->getLocale()} ?? null;
        @endphp
            @if($addr)
                <div><i class="bi bi-geo-alt-fill me-1"></i> {{ $addr }}</div>
            @endif
            @if($setting->phone)
                <div><i class="bi bi-telephone-fill me-1"></i> <a style="text-decoration: none; color: inherit" href="tel:{{ preg_replace('/[^0-9+]/', '', $setting->phone) }}">{{ $setting->phone }}</a></div>
            @endif
        <div class="ratio ratio-4x3 shadow">
          <iframe width="600" height="450" style="border:0;" loading="lazy" allowfullscreen
                  referrerpolicy="no-referrer-when-downgrade"
                  src="https://maps.google.com/maps?q={{ $lat }},{{ $lng }}&z=15&output=embed">
          </iframe>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
