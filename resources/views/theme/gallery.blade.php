@extends('theme.app')
@section('title', __('theme.gallery'))
@section('content')
    @push('styles')
<link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet" />
<style>
    .gallery-card{transition:transform .2s}
    .gallery-card:hover{transform:scale(1.02)}
    .filter-btn.active{background:#0d6efd;color:#fff}
</style>
@endpush

    @php
        $current = $categoryParam ?? 'all';
    @endphp
    @push('hero')
        @include('theme.partials.page-title', ['title' => __('theme.gallery')])
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
        <div class="mb-4 text-center d-flex flex-wrap justify-content-center">
            <div class="btn-group btn-group-sm" role="group" style="flex-wrap: wrap;">
                <button type="button" data-cat="all" class="btn btn-outline-primary filter-btn {{ $current=='all' ? 'active' : '' }}">@lang('gallery.all_'.app()->getLocale())</button>
                @foreach($categories as $cat)
                    <button type="button" data-cat="{{ $cat->id }}" class="btn btn-outline-primary filter-btn {{ $current==$cat->id ? 'active' : '' }}">
                        {{ $cat->{'service_name_'.app()->getLocale()} ?? $cat->service_name_en }}
                    </button>
                @endforeach
                <button type="button" data-cat="other" class="btn btn-outline-primary filter-btn {{ $current=='other' ? 'active' : '' }}">@lang('gallery.other_'.app()->getLocale())</button>
            </div>
        </div>

        <div class="row g-4" id="gallery-grid">
            @foreach($galleries as $gallery)
                @php
                    $typeField = 'treatment_type_' . app()->getLocale();
                    $categoryName = $gallery->service ? ($gallery->service->{'service_name_'.app()->getLocale()} ?? $gallery->service->service_name_en) : __('gallery.other');
                @endphp
                <div class="col-12 col-sm-6 col-lg-4 mb-4">
                    <div class="w-100 gallery-card h-100">
                        <h5 class="text-center mb-1">{{ $gallery->$typeField }}</h5>
                        <p class="text-center text-muted small mb-2">{{ $categoryName }}</p>
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
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded',()=>{
    document.querySelectorAll('.filter-btn').forEach(btn=>{
        btn.addEventListener('click',function(){
            document.querySelectorAll('.filter-btn').forEach(b=>b.classList.remove('active'));
            this.classList.add('active');
            const cat=this.dataset.cat;
            fetch(`{{ route('theme.gallery.ajax') }}?category=${cat}`)
                .then(r=>r.json())
                .then(d=>{
                    document.getElementById('gallery-grid').innerHTML=d.html;
                    GLightbox({ selector: '.gallery-lightbox' });
                });
        });
    });
});
</script>
@endpush
@endsection
