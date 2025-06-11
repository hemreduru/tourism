@extends('theme.app')

@push('hero')
    @include('theme.partials.page-title', ['title' => __('theme.about_us')])
@endpush

@section('content')
<section class="py-6">
    <div class="container">
        @php
            $titleField = 'title_' . $locale;
            $contentField = 'content_' . $locale;
        @endphp
        <h1 class="text-center mb-5">{{ $about->$titleField }}</h1>
        <div class="mx-auto py-5">
            {!! $about->$contentField !!}
        </div>
    </div>
</section>
@endsection
