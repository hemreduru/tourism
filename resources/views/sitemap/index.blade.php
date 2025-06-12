<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
    <!-- Ana Sayfa -->
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ Carbon\Carbon::now()->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
        @foreach($languages as $locale => $language)
            <xhtml:link rel="alternate" hreflang="{{ $locale }}" href="{{ url($locale != 'en' ? '/language/'.$locale : '/') }}" />
        @endforeach
    </url>

    <!-- Hakkımızda -->
    <url>
        <loc>{{ url('/about') }}</loc>
        <lastmod>{{ Carbon\Carbon::now()->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
        @foreach($languages as $locale => $language)
            <xhtml:link rel="alternate" hreflang="{{ $locale }}" href="{{ $locale != 'en' ? url('/language/'.$locale.'/about') : url('/about') }}" />
        @endforeach
    </url>

    <!-- Hizmetlerimiz -->
    <url>
        <loc>{{ url('/services') }}</loc>
        <lastmod>{{ Carbon\Carbon::now()->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
        @foreach($languages as $locale => $language)
            <xhtml:link rel="alternate" hreflang="{{ $locale }}" href="{{ $locale != 'en' ? url('/language/'.$locale.'/services') : url('/services') }}" />
        @endforeach
    </url>

    <!-- Partnerlerimiz -->
    <url>
        <loc>{{ url('/partners') }}</loc>
        <lastmod>{{ Carbon\Carbon::now()->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
        @foreach($languages as $locale => $language)
            <xhtml:link rel="alternate" hreflang="{{ $locale }}" href="{{ $locale != 'en' ? url('/language/'.$locale.'/partners') : url('/partners') }}" />
        @endforeach
    </url>

    <!-- İletişim -->
    <url>
        <loc>{{ url('/contact') }}</loc>
        <lastmod>{{ Carbon\Carbon::now()->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
        @foreach($languages as $locale => $language)
            <xhtml:link rel="alternate" hreflang="{{ $locale }}" href="{{ $locale != 'en' ? url('/language/'.$locale.'/contact') : url('/contact') }}" />
        @endforeach
    </url>

    <!-- Hizmet Sayfaları -->
    @foreach($services as $service)
        <url>
            <loc>{{ route('theme.service', $service->slug) }}</loc>
            <lastmod>{{ $service->updated_at->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.6</priority>
            @foreach($languages as $locale => $language)
                <xhtml:link rel="alternate" hreflang="{{ $locale }}" href="{{ $locale != 'en' ? url('/language/'.$locale.'/services/' . $service->slug) : route('theme.service', $service->slug) }}" />
            @endforeach
        </url>
    @endforeach

    <!-- Partner Sayfaları -->
    @foreach($partners as $partner)
        <url>
            <loc>{{ route('theme.partner', $partner->slug) }}</loc>
            <lastmod>{{ $partner->updated_at->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.5</priority>
            @foreach($languages as $locale => $language)
                <xhtml:link rel="alternate" hreflang="{{ $locale }}" href="{{ $locale != 'en' ? url('/language/'.$locale.'/partners/' . $partner->slug) : route('theme.partner', $partner->slug) }}" />
            @endforeach
        </url>
    @endforeach
</urlset>
