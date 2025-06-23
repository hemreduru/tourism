<nav class="navbar navbar-expand-lg navbar-dark fixed-top py-h3 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
    <div class="container">

        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('assets/img/logo/echt-zorg.logo.png') }}" width="250" alt="Echt Zorg Travel" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars navbar-toggler-icon"></i>
        </button>
        <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base">
                <li class="nav-item px-2"><a class="nav-link" aria-current="page" href="{{ route('home') }}">@lang('Home')</a></li>
                <li class="nav-item px-2"><a class="nav-link" href="{{ route('theme.about') }}">@lang('theme.about_us')</a></li>
                <li class="nav-item px-2"><a class="nav-link" href="{{ route('theme.services') }}">@lang('theme.our_services')</a></li>
                <li class="nav-item px-2"><a class="nav-link" href="{{ route('theme.partners') }}">@lang('theme.our_partners')</a></li>
                <li class="nav-item px-2"><a class="nav-link" href="{{ route('theme.gallery') }}">@lang('theme.gallery')</a>
                <li class="nav-item px-2"><a class="nav-link" href="{{ route('theme.faq') }}">@lang('faqs.faq')</a>
                <li class="nav-item px-2"><a class="nav-link" href="{{ route('theme.contact') }}">@lang('theme.contact')</a></li>
                <li class="nav-item dropdown px-2">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fi fi-{{ config('languages.available')[app()->getLocale()]['flag'] }} me-1"></span>
                        <span class="d-none d-sm-inline-block">{{ config('languages.available')[app()->getLocale()]['name'] }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                        @foreach(config('languages.available') as $locale => $language)
                            <li>
                                <a class="dropdown-item d-flex align-items-center {{ app()->getLocale() == $locale ? 'active' : '' }}" href="{{ route('language.switch', $locale) }}">
                                    <span class="fi fi-{{ $language['flag'] }} me-2"></span>
                                    {{ $language['name'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
            <a class="btn whatsapp-cta d-flex align-items-center gap-2 rounded-pill order-1 order-lg-0 ms-lg-4" href="https://wa.me/{{ preg_replace('/[^0-9+]/', '', $setting->whatsapp ?? '+31600000000') }}" target="_blank">
                <i class="bi bi-whatsapp fs-2"></i><span>@lang('theme.chat_us')</span>
            </a>
        </div>
    </div>
</nav>

<style>
    .whatsapp-cta {
        background-color: #25D366;
        color: white;
        font-weight: 500;
        box-shadow: 0 3px 8px rgba(37, 211, 102, 0.3);
        transition: all 0.3s ease;
        border: none;
        padding: 3px 12px;
        position: relative;
        animation: pulse 2s infinite;
        font-size: 0.85rem;
    }

    .whatsapp-cta:hover {
        background-color: #20ba57;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(37, 211, 102, 0.4);
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.6);
        }
        70% {
            box-shadow: 0 0 0 6px rgba(37, 211, 102, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
        }
    }

    .bi-whatsapp {
        font-size: 1rem;
    }

    /* Dil dropdown stilleri */
    .dropdown-menu {
        min-width: 10rem;
        border-radius: 0.5rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .dropdown-item {
        padding: 0.5rem 1rem;
    }

    .dropdown-item:hover {
        background-color: rgba(0, 0, 0, 0.05);
    }

    .dropdown-item.active {
        background-color: rgba(0, 0, 0, 0.075);
        color: inherit;
        font-weight: bold;
    }

    /* Flag Icons kütüphanesi için gerekli ek stil */
    .fi {
        width: 1.2em;
        height: 1.2em;
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;
        display: inline-block;
        position: relative;
        vertical-align: middle;
    }

    /* Önce/Sonra menü linklerinin satır kaydırmasını engelle */
    .navbar-nav .nav-link {
        white-space: nowrap !important;
    }
</style>
