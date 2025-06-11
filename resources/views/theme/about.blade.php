@extends('theme.app')

@push('hero')
    @include('theme.partials.page-title', ['title' => __('About Us')])
@endpush

@section('content')
<section class="py-6">
    <div class="container">
        @php
            $titleField = 'title_' . $locale;
            $contentField = 'content_' . $locale;
        @endphp
        <h1 class="text-center mb-5">{{ $about->$titleField }}</h1>
        <div class="mx-auto" style="max-width:900px">
            {!! $about->$contentField !!}
        </div>
    </div>
</section>
@endsection
