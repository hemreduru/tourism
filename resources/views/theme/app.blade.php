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

    <!-- JavaScripts -->
    <script src="{{ asset('vendors/@popperjs/popper.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/is/is.min.js') }}"></script>
    <script src="https://scripts.sirv.com/sirvjs/v3/sirv.js"></script>
    <script src="{{ asset('vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>

</body>
</html>
