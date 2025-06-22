@extends('theme.app')

@push('hero')
    @include('theme.partials.page-title', ['title' => $service->{'service_name_'.$locale}])
@endpush
@push('styles')
    <style>
        .sticky-sidebar {
            top: auto;
            transform: none;
            transition: top 1.5s ease, transform 1.5s ease;
        }

        .sticky-sidebar.is-fixed {
            top: 20%;
            transform: translateY(10%);
        }

        @media (max-width: 767.98px) {
            .sticky-sidebar {
                position: static !important;
                top: auto !important;
                transform: none !important;
            }
        }
    </style>
@endpush
@section('content')
<section class="py-7">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-3 text-center sticky-sidebar align-self-start">
                @if($service->image_path)
                    <img src="{{ asset($service->image_path) }}" alt="{{ $service->{'service_name_'.$locale} }}"
                         class="img-fluid rounded shadow">
                @endif
                <a href="{{ route('theme.contact') }}" target="_blank"
                   class="btn btn-primary rounded-pill w-100 mt-3">@lang('theme.hww_contact')</a>

            </div>
            <div class="col-lg-9">
                <h2>{{ $service->{'service_name_'.$locale} }}</h2>

                @php $contentField = 'content_'.$locale; @endphp
                <div class="mt-4">
                    {!! $service->$contentField !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            if (window.innerWidth >= 768) {
                var sidebar  = document.querySelector('.sticky-sidebar');
                var startTop = sidebar.getBoundingClientRect().top + window.scrollY;
                var trigger  = startTop - (window.innerHeight / 2);

                window.addEventListener('scroll', function(){
                    if (window.scrollY > trigger) {
                        sidebar.classList.add('is-fixed');
                    } else {
                        sidebar.classList.remove('is-fixed');
                    }
                });
            }
        });
    </script>
