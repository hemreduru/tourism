@extends('layouts.app')

@section('title', __('partners.edit_partner'))

@section('content_header')
    <h1>{{ __('partners.edit_partner') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">@lang('partners.partner_details')</h3>
                </div>
                <form action="{{ route('admin.partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="company_name_en">@lang('partners.company_name_en')</label>
                            <input type="text" name="company_name_en" id="company_name_en" class="form-control @error('company_name_en') is-invalid @enderror" value="{{ old('company_name_en', $partner->company_name_en) }}" required>
                            @error('company_name_en')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="company_name_tr">@lang('partners.company_name_tr')</label>
                            <input type="text" name="company_name_tr" id="company_name_tr" class="form-control @error('company_name_tr') is-invalid @enderror" value="{{ old('company_name_tr', $partner->company_name_tr) }}" required>
                            @error('company_name_tr')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="company_name_nl">@lang('partners.company_name_nl')</label>
                            <input type="text" name="company_name_nl" id="company_name_nl" class="form-control @error('company_name_nl') is-invalid @enderror" value="{{ old('company_name_nl', $partner->company_name_nl) }}" required>
                            @error('company_name_nl')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="logo">@lang('partners.logo')</label>
                            @if($partner->logo_path)
                                <div class="mb-2">
                                    <img src="{{ asset($partner->logo_path) }}" alt="{{ $partner->company_name_en }}" class="img-thumbnail" style="max-height: 100px;">
                                </div>
                            @endif
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="logo" id="logo" class="custom-file-input @error('logo') is-invalid @enderror">
                                    <label class="custom-file-label" for="logo">@lang('common.choose_file')</label>
                                </div>
                            </div>
                            @error('logo')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description_en">@lang('partners.description_en')</label>
                            <textarea name="description_en" id="description_en" class="form-control summernote @error('description_en') is-invalid @enderror" rows="3">{{ old('description_en', $partner->description_en) }}</textarea>
                            @error('description_en')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description_tr">@lang('partners.description_tr')</label>
                            <textarea name="description_tr" id="description_tr" class="form-control summernote @error('description_tr') is-invalid @enderror" rows="3">{{ old('description_tr', $partner->description_tr) }}</textarea>
                            @error('description_tr')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description_nl">@lang('partners.description_nl')</label>
                            <textarea name="description_nl" id="description_nl" class="form-control summernote @error('description_nl') is-invalid @enderror" rows="3">{{ old('description_nl', $partner->description_nl) }}</textarea>
                            @error('description_nl')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="website">@lang('partners.website')</label>
                            <input type="text" name="website" id="website" class="form-control @error('website') is-invalid @enderror" value="{{ old('website', $partner->website) }}">
                            @error('website')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="order">@lang('partners.order')</label>
                            <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', $partner->order) }}">
                            @error('order')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="is_active" class="custom-control-input" id="is_active" value="1" {{ old('is_active', $partner->is_active) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">@lang('common.active')</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">@lang('common.update')</button>
                        <a href="{{ route('admin.partners.index') }}" class="btn btn-default">@lang('common.cancel')</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    {{-- Summernote yapılandırması components/summernote.blade.php dosyasına taşındı --}}
@endpush
