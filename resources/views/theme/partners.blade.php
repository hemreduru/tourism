@extends('theme.app')
@section('title', __('theme.our_partners'))
@section('content')
    @push('hero')
        @include('theme.partials.page-title', ['title' => __('theme.our_partners')])
    @endpush
<section class="py-6">
    <div class="container">
{{--
        <h1 class="text-center mb-5">@lang('theme.our_partners')</h1>
--}}
        <div class="row g-4">
            @foreach($partners as $partner)
                @php $nameField = 'company_name_' . $locale; $descField = 'description_' . $locale; @endphp
                <div class="col-md-4">
                    <div class="card h-100 shadow text-center">
                        <img src="{{ asset($partner->logo_path) }}" class="card-img-top p-4" style="height:220px;object-fit:contain;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $partner->$nameField }}</h5>
                            <p class="card-text flex-grow-1">{{ Str::limit(strip_tags($partner->$descField),150,'...') }}</p>
                            <a href="{{ route('theme.partner', ['partner'=>$partner->id, 'slug'=>Str::slug($partner->company_name_en)]) }}" class="btn btn-primary mt-auto">@lang('Read More')</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
