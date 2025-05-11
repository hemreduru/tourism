<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePermissionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('permissions', 'name')->ignore($this->permission)
            ],
            'display_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['exists:roles,id']
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
            'name' => __('permissions.name'),
            'display_name' => __('permissions.display_name'),
            'description' => __('permissions.description'),
            'roles' => __('permissions.roles'),
            'roles.*' => __('permissions.roles'),
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => __('permissions.name_required'),
            'name.unique' => __('permissions.name_unique'),
            'display_name.required' => __('permissions.display_name_required'),
        ];
    }
}
