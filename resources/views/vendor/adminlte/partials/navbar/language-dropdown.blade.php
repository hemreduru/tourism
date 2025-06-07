{{-- Language Selector - Side by Side Flags --}}

@php
    $currentLocale = app()->getLocale();
    $languages = config('languages.available', []);
@endphp

@foreach($languages as $localeCode => $properties)
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icons@7.0.0/css/flag-icons.min.css">

    <li class="nav-item">
    <a href="{{ route('language.switch', $localeCode) }}"
       class="nav-link {{ $localeCode == $currentLocale ? 'active font-weight-bold' : 'text-muted' }}"
       title="{{ $properties['name'] }}">
        <span class="fi fi-{{ $properties['flag'] }}"></span>
    </a>
</li>
@endforeach
