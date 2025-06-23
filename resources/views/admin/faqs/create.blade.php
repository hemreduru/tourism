@extends('adminlte::page')
@section('title', __('faqs.add_faq'))
@section('content_header')
    <h1>{{ __('faqs.add_faq') }}</h1>
@stop
@section('content')
    <form action="{{ route('admin.faqs.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __('faqs.question_en') }}</label>
                    <input type="text" name="question_en" class="form-control @error('question_en') is-invalid @enderror" value="{{ old('question_en') }}" required>
                    @error('question_en') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __('faqs.question_tr') }}</label>
                    <input type="text" name="question_tr" class="form-control @error('question_tr') is-invalid @enderror" value="{{ old('question_tr') }}" required>
                    @error('question_tr') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __('faqs.question_nl') }}</label>
                    <input type="text" name="question_nl" class="form-control @error('question_nl') is-invalid @enderror" value="{{ old('question_nl') }}" required>
                    @error('question_nl') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __('faqs.answer_en') }}</label>
                    <textarea name="answer_en" class="form-control summernote @error('answer_en') is-invalid @enderror" required>{{ old('answer_en') }}</textarea>
                    @error('answer_en') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __('faqs.answer_tr') }}</label>
                    <textarea name="answer_tr" class="form-control summernote @error('answer_tr') is-invalid @enderror" required>{{ old('answer_tr') }}</textarea>
                    @error('answer_tr') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __('faqs.answer_nl') }}</label>
                    <textarea name="answer_nl" class="form-control summernote @error('answer_nl') is-invalid @enderror" required>{{ old('answer_nl') }}</textarea>
                    @error('answer_nl') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label>{{ __('faqs.order') }}</label>
                    <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', 0) }}" min="0" required>
                    @error('order') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>{{ __('faqs.status') }}</label><br>
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}> {{ __('faqs.active') }}
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('faqs.save') }}</button>
        <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">{{ __('faqs.cancel') }}</a>
    </form>
@stop
@section('js')

@stop

