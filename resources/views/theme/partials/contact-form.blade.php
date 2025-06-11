@php
    $slots= \App\Http\Controllers\Admin\ContactController::getTimeSlots();
@endphp
<form method="POST" action="{{ route('theme.contact.submit') }}" class="mx-auto" style="max-width:700px">
    @csrf
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">@lang('theme.name')</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">@lang('theme.phone')</label>
            <input type="text" name="phone" class="form-control">
        </div>
        <div class="col-md-3">
            <label class="form-label">@lang('theme.date')</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <div class="col-md-3">
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
    <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary rounded-pill px-5">@lang('theme.send')</button>
    </div>
</form>
