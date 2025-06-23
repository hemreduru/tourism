<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Authorization is handled via middleware/permissions
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array|\Illuminate\Contracts\Validation\ValidationRule|string>
     */
    public function rules(): array
    {
        $rules = [
            'name_en'     => ['required', 'string', 'max:255'],
            'name_tr'     => ['required', 'string', 'max:255'],
            'name_nl'     => ['required', 'string', 'max:255'],
            'title_en'    => ['nullable', 'string', 'max:255'],
            'title_tr'    => ['nullable', 'string', 'max:255'],
            'title_nl'    => ['nullable', 'string', 'max:255'],
            'comment_en'  => ['nullable', 'string'],
            'comment_tr'  => ['nullable', 'string'],
            'comment_nl'  => ['nullable', 'string'],
            'is_active'   => ['boolean'],
        ];

        if ($this->isMethod('post')) {
            $rules['image'] = ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'];
        } else {
            $rules['image'] = ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'];
        }

        return $rules;
    }

    /**
     * Custom messages (optional for brevity)
     */
    public function messages(): array
    {
        return [];
    }
}
