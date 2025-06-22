@once
    @push('scripts')
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endpush
@endonce
<div class="g-recaptcha d-flex justify-content-center" data-sitekey="{{ config('services.recaptcha.key') }}"></div>
