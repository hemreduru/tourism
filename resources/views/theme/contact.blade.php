@extends('theme.app')
@section('title', __('theme.contact'))
@section('content')
    @push('hero')
        @include('theme.partials.page-title', ['title' => __('theme.contact')])
    @endpush
<section class="py-6">
  <div class="container">
    {{--
        <h1 class="text-center mb-5">@lang('theme.contact')</h1>
    --}}
    <div class="row g-4">
      <div class="col-md-6">
        @include('theme.partials.contact-form')
      </div>
      <div class="col-md-6">
        <div class="ratio ratio-4x3 shadow">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1994.7714670678713!2d30.7226725!3d36.8848046!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzbcKwA4My4zIk4gMzDCsDQzJzE3LjkiRQ!5e0!3m2!1str!2str!4v1686382351356!5m2!1str!2str" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
