@php
    // central phone number from settings
    $phone = $setting->phone ?? '+31600000000';
@endphp
<a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="text-light" style="text-decoration:none">{{ $phone }}</a>
