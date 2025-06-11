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
            </div>
        </div>
    </div>
</section>
@endsection
