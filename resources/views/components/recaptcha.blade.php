@props(['action' => 'contact', 'input' => 'g-recaptcha-response'])

<input type="hidden" name="{{ $input }}" id="{{ $input }}">

@once
    @push('scripts')
        <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.key') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                grecaptcha.ready(function () {
                    grecaptcha.execute('{{ config('services.recaptcha.key') }}', {action: '{{ $action }}'}).then(function (token) {
                        document.getElementById('{{ $input }}').value = token;
                    });
                });
            });
        </script>
    @endpush
@endonce
