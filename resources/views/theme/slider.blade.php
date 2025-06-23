<section class="py-xxl-10 pb-0" id="home">
    <div class="bg-holder bg-size" style="background-image:url({{ asset('assets/img/gallery/hero-bg.png') }});background-position:top center;background-size:cover;"></div>

    <div class="container">
        <div class="row min-vh-xl-100 min-vh-xxl-25">
            <div class="col-md-5 col-xl-6 col-xxl-7 order-0 order-md-1 text-end">
                <img class="pt-7 pt-md-0 w-100" src="{{ asset('assets/img/gallery/hero.png') }}" alt="@lang('theme.slider.hero_alt')" />
            </div>
            <div class="col-md-75 col-xl-6 col-xxl-5 text-md-start text-center py-6">
                @php
                    $locale = app()->getLocale();
                    $heroHeadingField = 'hero_heading_' . $locale;
                    $heroDescField = 'hero_description_' . $locale;
                @endphp
                <h1 class="fw-light font-base fs-6 fs-xxl-7">
                    @if(!empty($setting->$heroHeadingField))
                        {!! $setting->$heroHeadingField !!}
                    @else
                        @lang('theme.slider.heading_part1') <strong>@lang('theme.slider.heading_strong1')</strong> @lang('theme.slider.heading_part2')<br />@lang('theme.slider.heading_part3')&nbsp;<strong>@lang('theme.slider.heading_strong2')</strong>
                    @endif
                </h1>
                <p class="fs-1 mb-5">
                    {{ $setting->$heroDescField ?? __('theme.slider.description') }}
                </p>
                <a class="btn btn-lg btn-primary rounded-pill" href="{{ route('theme.contact') }}" role="button">@lang('theme.make_appointment')</a>
            </div>
        </div>
    </div>
</section>
