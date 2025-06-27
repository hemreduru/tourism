@foreach($galleries as $gallery)
    @php
        $typeField = 'treatment_type_' . app()->getLocale();
        $categoryName = $gallery->service ? ($gallery->service->{"service_name_".app()->getLocale()} ?? $gallery->service->service_name_en) : __('gallery.other');
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
