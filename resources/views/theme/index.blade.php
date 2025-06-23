@extends('theme.app')

@section('content')
    @push('hero')
        @include('theme.slider')
    @endpush
    {{-- About Us Preview --}}
    <section class="py-10 bg-light ">
        <div class="container">
{{--
            <h2 class="text-center mb-5">@lang('About Us')</h2>
--}}
            @php
                $titleField = 'title_' . $locale;
                $contentField = 'content_' . $locale;
            @endphp
            @if($about)
                <h3 class="text-center mb-3">{{ $about->$titleField }}</h3>
                <br>
                <p class="mx-auto">
                    {{ Str::limit(strip_tags($about->$contentField), 500, '...') }}
                </p>
                <div class="text-center"><br>
                    <a href="{{ route('theme.about') }}" class="btn btn-primary rounded-pill">@lang('theme.read_more')</a>
                </div>
            @endif
        </div>
    </section>

    {{-- Services Section --}}
    <section class="py-7">
        <h2 class="text-center mb-5">@lang('theme.our_services')</h2>
        <div class="container">
            <div class="swiper servicesSwiper">
                <div class="swiper-wrapper">
                    @foreach($services as $service)
                        @php
                            $nameField = 'service_name_' . $locale;
                            $descField = 'short_description_' . $locale;
                        @endphp
                        <div class="swiper-slide service-slide">
                            <div class="card h-100 shadow text-center">
                                @if($service->image_path)
                                    <img src="{{ asset($service->image_path) }}" class="card-img-top" alt="service" style="height:26vh; object-fit:cover;">
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title mb-3">{{ $service->$nameField }}</h5>
                                    <p class="card-text flex-grow-1">{{ Str::limit(strip_tags($service->$descField), 200, '...') }}</p>
                                    <a href="{{ route('theme.service', ['service'=>$service->id,'slug'=>Str::slug($service->service_name_en)]) }}" class="btn btn-primary rounded-pill">@lang('theme.read_more')</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </section>

    {{-- Partners Carousel --}}
    <section class="py-6 bg-light-info">
        <div class="container">
            <h2 class="text-center mb-5">@lang('theme.our_partners')</h2>
            <div id="partnersCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($partners as $index => $partner)
                        @php
                            $nameField = 'company_name_' . $locale;
                            $descField = 'description_' . $locale;
                        @endphp
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }} text-center"> <a href="{{ route('theme.partner', ['partner'=>$partner->id,'slug'=>Str::slug($partner->company_name_en)]) }}" class="text-decoration-none">
                            <img src="{{ asset($partner->logo_path) }}" class="d-block img-fluid mx-auto mb-3" alt="logo" style="max-height:120px; width:auto;">
                           <h5>{{ $partner->$nameField }}</h5></a>
                            <p class="mx-auto" style="max-width:600px">{{ Str::limit(strip_tags($partner->$descField),150,'...') }}</p>
                            @if($partner->website)
                                <a href="{{ $partner->website }}" class="btn btn-accent" target="_blank">@lang('theme.visit_website')</a>
                            @endif
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#partnersCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">@lang('common.previous')</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#partnersCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">@lang('common.next')</span>
                </button>
            </div>
        </div>
    </section>

    {{-- Testimonials Section --}}
    @if($testimonials->count())
        <section id="testimonials" class="py-6 bg-light position-relative overflow-hidden">
            <div class="container">
                <h2 class="text-center mb-5 font-weight-bold">@lang('testimonials.testimonials')</h2>
                <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($testimonials->chunk(2) as $key => $chunk)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                <div class="row g-4 justify-content-center">
                                    @foreach($chunk as $testimonial)
                                        <div class="col-12 col-md-6">
                                            <div class="p-4 h-100 bg-white rounded text-center">
                                                @if($testimonial->image_path)
                                                    <img src="/{{ $testimonial->image_path }}" class="rounded-circle shadow mb-3" alt="{{ $testimonial->name }}" style="width:90px;height:90px;object-fit:cover;">
                                                @endif
                                                <p class="testimonial-comment small mb-3 text-muted">“{!! Str::limit(strip_tags($testimonial->{'comment_'.app()->getLocale()}),512,'...') !!}”</p>
                                                <h6 class="mb-0 font-weight-bold">{{ $testimonial->{'name_'.app()->getLocale()} }}</h6>
                                                @if($testimonial->{'title_'.app()->getLocale()})
                                                    <small class="text-secondary">{{ $testimonial->{'title_'.app()->getLocale()} }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($testimonials->count() > 2)
                        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">@lang('common.previous')</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">@lang('common.next')</span>
                        </button>
                    @endif
                </div>
            </div>
        </section>
    @endif

    {{-- Gallery Section --}}
    @if($galleries->count())
        <section id="gallery" class="py-6 bg-light">
            <div class="container">
                <h2 class="text-center mb-5 font-weight-bold">@lang('theme.gallery')</h2>
                <div class="row g-4">
                    @foreach($galleries as $gallery)
                        @php $typeField = 'treatment_type_' . $locale; @endphp
                        <div class="col-12 col-md-6 col-lg-4 d-flex">
                            <div class="w-100">
                                <h5 class="text-center mb-3">{{ $gallery->$typeField }}</h5>
                                <div class="d-flex gap-2 align-items-stretch">
                                    <div class="w-50">
                                        <img src="/{{ $gallery->before_image_path }}" alt="@lang('gallery.before_image')" class="img-fluid rounded shadow" style="object-fit:cover;width:100%;height:100%;">
                                    </div>
                                    <div class="w-50">
                                        <img src="/{{ $gallery->after_image_path }}" alt="@lang('gallery.after_image')" class="img-fluid rounded shadow" style="object-fit:cover;width:100%;height:100%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Contact Form --}}
    <section class="py-6" id="apply">
        <h2 class="text-center mb-5">@lang('theme.contact')</h2>
        @include('theme.partials.contact-form')
    </section>
@endsection

@push('styles')
    <style>
        /* Slayt içindeki kartların hizalanması ve tüm kartların aynı boyda kalması */
        .servicesSwiper .swiper-wrapper {
            align-items: stretch;
        }

        .servicesSwiper .swiper-slide .card {
            height: 100%;
        }

        /* Açıklama alanını sabit yükseklikte tut, fazla içeriği kırp */
        .servicesSwiper .card-text {
            display: -webkit-box;
            -webkit-line-clamp: 5; /* en fazla 5 satır göster */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            min-height: 7.5rem; /* 5 satır ~ 7.5rem */
        }

        /* Partners & Testimonials responsive tweaks */
        #partnersCarousel img {
            max-width: 80%;
            height: auto;
        }
        #testimonialCarousel .carousel-item {
            transition: transform 0.6s ease;
        }
        #testimonialCarousel .p-4 {
            background: #fff;
        }
        #testimonialCarousel .testimonial-comment {
            display: -webkit-box;
            -webkit-line-clamp: 6; /* show max 6 lines */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            word-wrap: break-word;
        }
        @media (min-width: 768px) {
            #testimonialCarousel .carousel-item {
                padding: 0 2rem;
            }
        }
        @media (max-width: 767.98px) {
            #testimonialCarousel .carousel-item .col-md-6:nth-child(n+2) {
                display: none;
            }
        }
        @media (max-width: 575.98px) {
            #partnersCarousel img {
                max-width: 60%;
            }
            /* Hide nav arrows on very small screens to save space */
            #partnersCarousel .carousel-control-prev,
            #partnersCarousel .carousel-control-next {
                display: none;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Swiper('.servicesSwiper', {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    576: {
                        slidesPerView: 2
                    },
                    992: {
                        slidesPerView: 2
                    }
                }
            });
        });
    </script>
@endpush
