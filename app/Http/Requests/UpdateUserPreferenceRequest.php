<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPreferenceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Sadece kendi tercihlerini değiştirebilir
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
            'dark_mode' => 'boolean',
            'sidebar_color' => 'required|string|max:50',
            'navbar_color' => 'required|string|max:50',
            'accent_color' => 'required|string|max:20',
            'layout_boxed' => 'nullable|boolean',
            'layout_fixed_sidebar' => 'nullable|boolean',
            'layout_fixed_navbar' => 'nullable|boolean',
            'layout_fixed_footer' => 'nullable|boolean',
            'sidebar_collapsed' => 'boolean',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'dark_mode' => __('preferences.dark_mode'),
            'sidebar_color' => __('preferences.sidebar_color'),
            'navbar_color' => __('preferences.navbar_color'),
            'accent_color' => __('preferences.accent_color'),
            'layout_boxed' => __('preferences.layout_boxed'),
            'layout_fixed_sidebar' => __('preferences.layout_fixed_sidebar'),
            'layout_fixed_navbar' => __('preferences.layout_fixed_navbar'),
            'layout_fixed_footer' => __('preferences.layout_fixed_footer'),
            'sidebar_collapsed' => __('preferences.sidebar_collapsed'),
        ];
    }
}
