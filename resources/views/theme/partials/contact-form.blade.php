@php
    $slots= \App\Http\Controllers\Admin\ContactController::getTimeSlots();
@endphp
<form method="POST" action="{{ route('theme.contact.submit') }}" class="contact-form mx-auto px-3 px-md-0" style="max-width:700px">
    @csrf
    <div class="row g-3">
        <div class="col-12 col-md-6">
            <label class="form-label">@lang('theme.name')</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="col-12 col-md-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="col-12 col-md-6">
            <label class="form-label">@lang('theme.phone')</label>
            <input type="text" name="phone" class="form-control">
        </div>
        <div class="col-12 col-md-3">
            <label class="form-label">@lang('theme.date')</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <div class="col-12 col-md-3">
            <label class="form-label">@lang('theme.time_slot')</label>
            <select name="time_slot" class="form-select" required>
                @foreach($slots as $s)
                    <option value="{{ $s }}">{{ $s }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12">
            <label class="form-label">@lang('theme.message')</label>
            <textarea name="message" class="form-control" rows="4"></textarea>
        </div>
    </div>
    <div class="my-3">
        <x-recaptcha />
    </div>
    <div class="d-grid d-md-flex justify-content-center mt-3">
        <button type="submit" class="btn btn-primary rounded-pill px-5">@lang('theme.send')</button>
    </div>
</form>
@push('styles')
    <style>
        @media (max-width: 575.98px) {
            .contact-form {
                max-width: 100% !important;
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
    </style>
@endpush
