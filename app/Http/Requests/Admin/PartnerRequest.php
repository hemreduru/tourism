<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PartnerRequest extends FormRequest
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
            'description_en' => ['nullable', 'string'],
            'description_tr' => ['nullable', 'string'],
            'description_nl' => ['nullable', 'string'],
            'website' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer'],
            'is_active' => ['boolean'],
        ];

        if ($this->isMethod('post')) {
            $rules['logo'] = ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'];
        } else {
            $rules['logo'] = ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'company_name_en.required' => __('validation.required', ['attribute' => __('partners.company_name_en')]),
            'company_name_tr.required' => __('validation.required', ['attribute' => __('partners.company_name_tr')]),
            'company_name_nl.required' => __('validation.required', ['attribute' => __('partners.company_name_nl')]),
            'logo.required' => __('validation.required', ['attribute' => __('partners.logo')]),
            'logo.image' => __('validation.image', ['attribute' => __('partners.logo')]),
            'logo.mimes' => __('validation.mimes', ['attribute' => __('partners.logo'), 'values' => 'jpeg,png,jpg,gif,svg']),
            'logo.max' => __('validation.max.file', ['attribute' => __('partners.logo'), 'max' => '2048']),
        ];
    }
}
