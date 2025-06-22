<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Recaptcha;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'       => 'required|string|max:255',
            'email'      => 'required|email',
            'phone'      => 'nullable|string|max:30',
            'date'       => 'required|date',
            'time_slot'  => 'required|string|max:100',
            'message'    => 'nullable|string',
            'g-recaptcha-response' => ['required', new Recaptcha()],
        ];
    }
}
