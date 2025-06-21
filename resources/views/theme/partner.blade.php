@extends('theme.app')

@push('hero')
    @include('theme.partials.page-title', ['title' => __('theme.our_partners')])
@endpush

@section('content')
<section class="py-7">
    <div class="container">
        <div class="row g-5 align-items-start">
            <div class="col-md-4 text-center">
                <img src="{{ asset($partner->logo_path) }}" alt="logo" class="img-fluid rounded shadow mb-4" style="max-height:220px; object-fit:contain;">
                @if($partner->website)
                    <a href="{{ $partner->website }}" target="_blank" class="btn btn-primary rounded-pill w-100">@lang('theme.visit_website')</a>
                @endif
            </div>
            <div class="col-md-8">
                <h2 class="mb-4">{{ $partner->{'company_name_'.$locale} }}</h2>
                <div class="content">{!! $partner->{'description_'.$locale} !!}</div>
                @if($partner->has_map && $partner->latitude && $partner->longitude)
                    <div id="partnerMap" style="height:300px;" class="mt-4"></div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    @if($partner->has_map && $partner->latitude && $partner->longitude)
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const map = L.map('partnerMap').setView([{{ $partner->latitude }}, {{ $partner->longitude }}], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                }).addTo(map);
                L.marker([{{ $partner->latitude }}, {{ $partner->longitude }}]).addTo(map);
            });
        </script>
    @endif
@endpush
