<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAboutUsRequest extends FormRequest
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
            'title_en' => ['required', 'string', 'max:255'],
            'title_tr' => ['required', 'string', 'max:255'],
            'title_nl' => ['required', 'string', 'max:255'],
            'content_en' => ['required', 'string'],
            'content_tr' => ['required', 'string'],
            'content_nl' => ['required', 'string'],
            'is_active' => ['boolean'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title_en.required' => __('validation.required', ['attribute' => 'English Title']),
            'title_tr.required' => __('validation.required', ['attribute' => 'Turkish Title']),
            'title_nl.required' => __('validation.required', ['attribute' => 'Dutch Title']),
            'content_en.required' => __('validation.required', ['attribute' => 'English Content']),
            'content_tr.required' => __('validation.required', ['attribute' => 'Turkish Content']),
            'content_nl.required' => __('validation.required', ['attribute' => 'Dutch Content']),
        ];
    }
}
