<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignPermissionRoleRequest extends FormRequest
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
            'role_id' => ['required', 'exists:roles,id'],
            'permission_ids' => ['required', 'array'],
            'permission_ids.*' => ['exists:permissions,id'],
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
            'role_id' => __('permissions.roles'),
            'permission_ids' => __('permissions.permissions'),
            'permission_ids.*' => __('permissions.permissions'),
        ];
    }
}
