<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'roles' => ['required', 'array'],
            'roles.*' => ['exists:roles,id'],
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
            'name.required' => __('validation.required', ['attribute' => __('users.name')]),
            'email.required' => __('validation.required', ['attribute' => __('users.email')]),
            'email.email' => __('validation.email', ['attribute' => __('users.email')]),
            'email.unique' => __('validation.unique', ['attribute' => __('users.email')]),
            'password.required' => __('validation.required', ['attribute' => __('users.password')]),
            'password.min' => __('validation.min.string', ['attribute' => __('users.password'), 'min' => 8]),
            'password.confirmed' => __('validation.confirmed', ['attribute' => __('users.password')]),
            'roles.required' => __('validation.required', ['attribute' => __('users.roles')]),
        ];
    }
}
