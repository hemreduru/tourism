@extends('theme.app')

@section('content')
    {{-- About Us Preview --}}
    <section class="py-6 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">@lang('About Us')</h2>
            @php
                $titleField = 'title_' . $locale;
                $contentField = 'content_' . $locale;
            @endphp
            @if($about)
                <h3 class="text-center mb-3">{{ $about->$titleField }}</h3>
                <p class="mx-auto" style="max-width:800px">
                    {{ Str::limit(strip_tags($about->$contentField), 200, '...') }}
                </p>
                <div class="text-center">
                    <a href="{{ route('theme.about') }}" class="btn btn-primary rounded-pill">@lang('Read More')</a>
                </div>
            @endif
        </div>
    </section>

    {{-- Partners Carousel --}}
    <section class="py-6 bg-light-info">
        <div class="container">
            <h2 class="text-center mb-5">@lang('theme.our_partners')</h2>
            <div id="partnersCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($partners as $index => $partner)
                        @php
                            $nameField = 'company_name_' . $locale;
                            $descField = 'description_' . $locale;
                        @endphp
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }} text-center">
                            <img src="{{ asset($partner->logo_path) }}" class="d-block mx-auto mb-3" alt="logo" style="max-height:120px">
                            <a href="{{ route('theme.partner', $partner->id) }}" class="text-decoration-none"><h5>{{ $partner->$nameField }}</h5></a>
                            <p class="mx-auto" style="max-width:600px">{{ Str::limit(strip_tags($partner->$descField),150,'...') }}</p>
                            @if($partner->website)
                                <a href="{{ $partner->website }}" class="btn btn-accent" target="_blank">@lang('theme.visit_website')</a>
                            @endif
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#partnersCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">@lang('Previous')</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#partnersCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">@lang('Next')</span>
                </button>
            </div>
        </div>
    </section>

    {{-- Contact Form --}}
    <section class="py-6" id="apply">
        <div class="container">
            <h2 class="text-center mb-5">@lang('Apply Now')</h2>
            @if(session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('theme.contact.submit') }}" class="mx-auto" style="max-width:700px">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">@lang('Name')</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">@lang('Phone')</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">@lang('Date')</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">@lang('Time Slot')</label>
                        @php $slots=\App\Http\Controllers\Admin\ContactController::getTimeSlots(); @endphp
                        <select name="time_slot" class="form-select" required>
                            @foreach($slots as $s)
                            <option value="{{ $s }}">{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">@lang('Message')</label>
                        <textarea name="message" class="form-control" rows="4"></textarea>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary rounded-pill px-5">@lang('Send')</button>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('hero')
    @include('theme.slider')
@endpush
