@extends('theme.app')

@push('hero')
    @include('theme.partials.page-title', ['title' => __('theme.our_partners')])
@endpush

@section('content')
<section class="py-6">
    <div class="container text-center">
        <img src="{{ asset($partner->logo_path) }}" alt="logo" class="mb-4" style="max-height:150px">
        <h2 class="mb-3">{{ $partner->{'company_name_'.$locale} }}</h2>
        <div class="mx-auto" style="max-width:800px">
            {!! $partner->{'description_'.$locale} !!}
        </div>
        @if($partner->website)
            <a href="{{ $partner->website }}" target="_blank" class="btn btn-accent mt-4">@lang('Visit Website')</a>
        @endif
    </div>
</section>
@endsection
