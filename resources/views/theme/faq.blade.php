@extends('theme.app')
@push('hero')
    @include('theme.partials.page-title', ['title' => __('faqs.faqs')])
@endpush

@section('content')
<div class="container py-5">
    <div class="accordion" id="faqAccordion">
        @php
            $locale = app()->getLocale();
        @endphp
        @forelse($faqs as $faq)
            <div class="accordion-item mb-2">
                <h2 class="accordion-header" id="heading{{ $faq->id }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapse{{ $faq->id }}">
                        {{ $faq['question_' . $locale] }}
                    </button>
                </h2>
                <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        {!! $faq['answer_' . $locale] !!}
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info text-center">{{ __('faqs.no_faqs_found') }}</div>
        @endforelse
    </div>
</div>
@endsection
