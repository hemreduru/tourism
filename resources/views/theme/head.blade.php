<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{-- SEO Meta Tags --}}
    <meta name="description" content="@yield('meta_description', 'Echt Zorg Travel offers leading health tourism and partner services in Turkey and Europe.')">
    <meta name="keywords" content="@yield('meta_keywords', 'health tourism, medical travel, surgery in turkey, medical tourism')">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">
    <link rel="canonical" href="{{ url()->current() }}"/>

    {{-- OpenGraph / Facebook --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('og_title', View::hasSection('title') ? trim(View::yieldContent('title')) : 'Echt Zorg Travel')">
    <meta property="og:description" content="@yield('og_description', View::hasSection('meta_description') ? trim(View::yieldContent('meta_description')) : 'Echt Zorg Travel offers leading health tourism and partner services.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('assets/img/favicons/android-chrome-512x512.png'))">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', View::hasSection('title') ? trim(View::yieldContent('title')) : 'Echt Zorg Travel')">
    <meta name="twitter:description" content="@yield('og_description', View::hasSection('meta_description') ? trim(View::yieldContent('meta_description')) : 'Echt Zorg Travel offers leading health tourism and partner services.')">
    <meta name="twitter:image" content="@yield('og_image', asset('assets/img/favicons/android-chrome-512x512.png'))">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Echt Zorg Travel | Health Tourism')</title>

    <!-- Favicons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css" />

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('assets/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Stylesheets -->
    <link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />

    <!-- Google Fonts & others -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100&display=swap" rel="stylesheet">

    @stack('meta')
    @stack('styles')
</head>
