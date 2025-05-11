<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
        @php
            $currentLocale = app()->getLocale();
            $currentLanguage = config('languages.available.'.$currentLocale, ['flag' => 'us']);
        @endphp
        <i class="flag-icon flag-icon-{{ $currentLanguage['flag'] }}"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right p-0">
        @foreach(config('languages.available') as $localeCode => $properties)
            <a href="{{ route('language.switch', $localeCode) }}"
               class="dropdown-item {{ $localeCode == $currentLocale ? 'active' : '' }}">
                <i class="flag-icon flag-icon-{{ $properties['flag'] }} mr-2"></i> {{ $properties['name'] }}
            </a>
        @endforeach
    </div>
</li>
