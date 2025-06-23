@extends('theme.app')
@section('title', __('theme.our_services'))
@section('content')

@push('hero')
    @include('theme.partials.page-title', ['title' => __('theme.our_services')])
@endpush
<section class="py-6">
    <div class="container">
{{--
        <h1 class="text-center mb-5">@lang('theme.our_services')</h1>
--}}
        <div class="row g-4">
            @foreach($services as $service)
                @php $nameField = 'service_name_' . $locale; $descField = 'short_description_' . $locale; @endphp
                <div class="col-md-4">
                    <div class="card h-100 shadow">
                        @if($service->image_path)
                            <img src="{{ asset($service->image_path) }}" class="card-img-top" style="height:220px;object-fit:cover;">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $service->$nameField }}</h5>
                            <p class="card-text flex-grow-1">{{ Str::limit(strip_tags($service->$descField),150,'...') }}</p>
                            <a href="{{ route('theme.service',['service'=>$service->id,'slug'=>Str::slug($service->service_name_en)]) }}" class="btn btn-primary mt-auto">@lang('theme.read_more')</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
