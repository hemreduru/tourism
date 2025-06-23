@extends('theme.app')
@section('title', __('theme.gallery'))
@section('content')
    @push('hero')
        @include('theme.partials.page-title', ['title' => __('theme.gallery')])
    @endpush
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet" />
<style>
    .gallery-card{transition:transform .2s}
    .gallery-card:hover{transform:scale(1.02)}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        GLightbox({ selector: '.gallery-lightbox' });
    });
</script>
@endpush

<section class="py-7">
    <div class="container">
        <div class="row g-4">
            @foreach($galleries as $gallery)
                @php
                    $typeField = 'treatment_type_' . app()->getLocale();
                @endphp
                <div class="col-12 col-sm-6 col-lg-4 mb-4">
                    <div class="w-100 gallery-card h-100">
                        <h5 class="text-center mb-3">{{ $gallery->$typeField }}</h5>
                        <div class="row gx-2">
                            <div class="col-6 mb-2">
                                <a href="/{{ $gallery->before_image_path }}" class="gallery-lightbox" data-gallery="gallery-{{ $gallery->id }}">
                                    <img src="/{{ $gallery->before_image_path }}" alt="@lang('gallery.before_image')" class="img-fluid rounded shadow-sm" style="object-fit:cover;width:100%;height:180px;">
                                </a>
                            </div>
                            <div class="col-6 mb-2">
                                <a href="/{{ $gallery->after_image_path }}" class="gallery-lightbox" data-gallery="gallery-{{ $gallery->id }}">
                                    <img src="/{{ $gallery->after_image_path }}" alt="@lang('gallery.after_image')" class="img-fluid rounded shadow-sm" style="object-fit:cover;width:100%;height:180px;">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
