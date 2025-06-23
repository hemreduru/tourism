@extends('theme.app')

@push('hero')
    @include('theme.partials.page-title', ['title' => $policy->{'title_' . $locale}])
@endpush

@section('content')
<section class="py-6">
    <div class="container">
        {!! $policy->{'content_' . $locale} !!}
    </div>
</section>
@endsection
