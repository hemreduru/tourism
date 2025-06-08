<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
        $rules = [
            'company_name_en' => ['required', 'string', 'max:255'],
            'company_name_tr' => ['required', 'string', 'max:255'],
            'company_name_nl' => ['required', 'string', 'max:255'],
            'short_description_en' => ['nullable', 'string'],
            'short_description_tr' => ['nullable', 'string'],
            'short_description_nl' => ['nullable', 'string'],
            'content_en' => ['nullable', 'string'],
            'content_tr' => ['nullable', 'string'],
            'content_nl' => ['nullable', 'string'],
            'link' => ['nullable', 'string', 'max:255'],
            'is_active' => ['boolean'],
        ];

        if ($this->isMethod('post')) {
            $rules['image'] = ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'];
        } else {
            $rules['image'] = ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'company_name_en.required' => __('validation.required', ['attribute' => __('services.company_name_en')]),
            'company_name_tr.required' => __('validation.required', ['attribute' => __('services.company_name_tr')]),
            'company_name_nl.required' => __('validation.required', ['attribute' => __('services.company_name_nl')]),
            'company_name_en.max' => __('validation.max.string', ['attribute' => __('services.company_name_en'), 'max' => 255]),
            'company_name_tr.max' => __('validation.max.string', ['attribute' => __('services.company_name_tr'), 'max' => 255]),
            'company_name_nl.max' => __('validation.max.string', ['attribute' => __('services.company_name_nl'), 'max' => 255]),
            'image.required' => __('validation.required', ['attribute' => __('services.image')]),
            'image.image' => __('validation.image', ['attribute' => __('services.image')]),
            'image.mimes' => __('validation.mimes', ['attribute' => __('services.image'), 'values' => 'jpeg, png, jpg, gif, svg']),
            'image.max' => __('validation.max.file', ['attribute' => __('services.image'), 'max' => 2048]),
            'link.url' => __('validation.url', ['attribute' => __('services.link')]),
            'link.max' => __('validation.max.string', ['attribute' => __('services.link'), 'max' => 255]),
        ];
    }
}
