<footer>
    <section class="py-0 bg-secondary">
        <div class="bg-holder opacity-25" style="background-image:url({{ asset('assets/img/gallery/dot-bg.png') }});background-position:top left;margin-top:-3.125rem;background-size:auto;"></div>
        <div class="container">
            <div class="row py-5">
                <div class="col-md-6 mb-4 text-center text-md-start">
                    <a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo/echt-zorg.logo.png') }}" height="50" alt="Echt Zorg Travel"></a>
                    <p class="text-light mt-3 mb-0">@lang('theme.footer_text')</p>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <h6 class="text-light fw-bold mb-2">@lang('Quick Links')</h6>
                    <ul class="list-unstyled">
                        <li><a class="footer-link" href="{{ route('home') }}">@lang('Home')</a></li>
                        <li><a class="footer-link" href="{{ route('theme.about') }}">@lang('theme.about_us')</a></li>
                        <li><a class="footer-link" href="{{ route('theme.services') }}">@lang('theme.our_services')</a></li>
                        <li><a class="footer-link" href="{{ route('theme.contact') }}">@lang('theme.contact')</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <h6 class="text-light fw-bold mb-2">@lang('Contact')</h6>
                    <ul class="list-unstyled text-light">
                        <li class="mb-1"><i class="bi bi-telephone me-1"></i> @include('theme.partials.phone')</li>
                        <li><i class="bi bi-envelope me-1"></i> <a class="text-light" style="text-decoration: none; cursor: default;" href="mailto:info@echtzorgtravel.nl">info@echtzorgtravel.nl</a></li>
                    </ul>
                </div>
            </div>
            <div class="text-center border-top border-light pt-3 pb-2 text-400">
                &copy; {{ date('Y') }} Echt Zorg Travel
            </div>
        </div>
    </section>
</footer>
