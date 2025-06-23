<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PolicyRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Authorization handled via middleware/permissions at route level
        return true;
    }

    public function rules(): array
    {
        return [
            'type'        => ['required', Rule::in(['privacy', 'terms', 'gdpr'])],
            'title_en'    => ['required', 'string', 'max:255'],
            'title_tr'    => ['required', 'string', 'max:255'],
            'title_nl'    => ['required', 'string', 'max:255'],
            'content_en'  => ['required', 'string'],
            'content_tr'  => ['required', 'string'],
            'content_nl'  => ['required', 'string'],
            'is_active'   => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'type.required'   => __('validation.required', ['attribute' => __('policies.type')]),
            'type.in'         => __('validation.in', ['attribute' => __('policies.type')]),
            'title_en.required' => __('validation.required', ['attribute' => __('policies.title_en')]),
            'title_tr.required' => __('validation.required', ['attribute' => __('policies.title_tr')]),
            'title_nl.required' => __('validation.required', ['attribute' => __('policies.title_nl')]),
            'content_en.required' => __('validation.required', ['attribute' => __('policies.content_en')]),
            'content_tr.required' => __('validation.required', ['attribute' => __('policies.content_tr')]),
            'content_nl.required' => __('validation.required', ['attribute' => __('policies.content_nl')]),
        ];
    }
}
