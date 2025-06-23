<div class="bg-light-info py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 text-center py-5">
                @php
                    $locale = app()->getLocale();
                    $tfHeadingField = 'top_footer_heading_' . $locale;
                    $tfLeadField = 'top_footer_lead_' . $locale;
                @endphp
                <h2 class="display-4">
                    {!! $setting->$tfHeadingField ?? __('theme.vibrante_tourism_health') !!}
                </h2>
                <p class="lead">
                    {{ $setting->$tfLeadField ?? __('theme.take_first_step') }}
                </p>
                <div class="mt-5">
                    <a class="btn btn-lg btn-primary rounded-pill" href="{{ route('theme.contact') }}" role="button">
                        @lang('theme.make_appointment')
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
