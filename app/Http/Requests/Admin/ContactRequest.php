<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'date' => ['required', 'date'],
            'time_slot' => ['required', 'string'],
            'message_en' => ['nullable', 'string'],
            'message_tr' => ['nullable', 'string'],
            'message_nl' => ['nullable', 'string'],
            'status_id' => ['required', 'exists:statuses,id'],
            'language' => ['required', 'string', 'max:10'],
            'is_read' => ['boolean'],
            'is_responded' => ['boolean'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => __('validation.required', ['attribute' => __('contacts.name')]),
            'email.required' => __('validation.required', ['attribute' => __('contacts.email')]),
            'email.email' => __('validation.email', ['attribute' => __('contacts.email')]),
            'date.required' => __('validation.required', ['attribute' => __('contacts.date')]),
            'date.date' => __('validation.date', ['attribute' => __('contacts.date')]),
            'time_slot.required' => __('validation.required', ['attribute' => __('contacts.time_slot')]),
            'status_id.required' => __('validation.required', ['attribute' => __('contacts.status_id')]),
            'status_id.exists' => __('validation.exists', ['attribute' => __('contacts.status_id')]),
        ];
    }
}
