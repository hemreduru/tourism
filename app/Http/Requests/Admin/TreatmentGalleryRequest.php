<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TreatmentGalleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // handled by middleware
    }

    public function rules(): array
    {
        $rules = [
            'treatment_type_en' => ['required', 'string', 'max:255'],
            'treatment_type_tr' => ['required', 'string', 'max:255'],
            'treatment_type_nl' => ['required', 'string', 'max:255'],
            'is_active' => ['boolean'],
            'order'     => ['nullable', 'integer', 'min:0'],
        ];

        if ($this->isMethod('post')) {
            $rules['before_image'] = ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'];
            $rules['after_image']  = ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'];
        } else {
            $rules['before_image'] = ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'];
            $rules['after_image']  = ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'treatment_type_en.required' => __('validation.required', ['attribute' => __('gallery.treatment_type_en')]),
            'treatment_type_tr.required' => __('validation.required', ['attribute' => __('gallery.treatment_type_tr')]),
            'treatment_type_nl.required' => __('validation.required', ['attribute' => __('gallery.treatment_type_nl')]),
            'before_image.required' => __('validation.required', ['attribute' => __('gallery.before_image')]),
            'after_image.required' => __('validation.required', ['attribute' => __('gallery.after_image')]),
        ];
    }
}
