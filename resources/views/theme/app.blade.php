<!DOCTYPE html>
<html lang="en-US" dir="ltr">
@include('theme.head')
<body>
    <main class="main" id="top">
        @include('theme.header')
        @stack('hero')
        @yield('content')
    </main>
    @include('theme.partials.top-footer')
    @include('theme.footer')
    @stack('scripts')
    <script src="{{ asset('js/cookieConsent.js') }}"></script>
    <script>
        window.addEventListener("load", function () {
            window.cookieconsent.initialise({
                "palette": {
                    "popup": {
                        "background": "#000"
                    },
                    "button": {
                        "background": "#f1d600"
                    }
                },
                "theme": "classic",
                "position": "bottom-right",
                "content": {
                    "message": "{{ __('theme.cookie.message') }}",
                    "dismiss": "{{ __('theme.cookie.dismiss') }}",
                    "link": "{{ __('theme.cookie.link') }}",
                    "href": "{{ __('theme.cookie.href') }}"
                }
            });
        });
    </script>
    <!-- JavaScripts -->
    <script src="{{ asset('vendors/@popperjs/popper.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/is/is.min.js') }}"></script>
    <script src="https://scripts.sirv.com/sirvjs/v3/sirv.js"></script>
    <script src="{{ asset('vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>

</body>
</html>
