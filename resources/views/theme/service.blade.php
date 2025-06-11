@extends('theme.app')

@push('hero')
    @include('theme.partials.page-title', ['title' => $service->{'service_name_'.$locale}])
@endpush

@section('content')
<section class="py-lg-11">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5 text-center">
                @if($service->image_path)
                    <img src="{{ asset($service->image_path) }}" alt="{{ $service->{'service_name_'.$locale} }}" class="img-fluid rounded shadow">
                @endif
            </div>
            <div class="col-lg-7">
                <h2>{{ $service->{'service_name_'.$locale} }}</h2>
                @php $contentField = 'content_'.$locale; @endphp
                <div class="mt-4">
                    {!! $service->$contentField !!}
                </div>
                @if($service->link)
                    <a href="{{ $service->link }}" target="_blank" class="btn btn-primary rounded-pill mt-4">@lang('theme.visit_website')</a>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
