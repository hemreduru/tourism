{{-- Language Selector - Side by Side Flags --}}

@php
    $currentLocale = app()->getLocale();
    $languages = config('languages.available', []);
@endphp

@foreach($languages as $localeCode => $properties)
<li class="nav-item">
    <a href="{{ route('language.switch', $localeCode) }}"
       class="nav-link {{ $localeCode == $currentLocale ? 'active font-weight-bold' : 'text-muted' }}"
       title="{{ $properties['name'] }}">
        <i class="flag-icon flag-icon-{{ $properties['flag'] }}"></i>
    </a>
</li>
@endforeach
