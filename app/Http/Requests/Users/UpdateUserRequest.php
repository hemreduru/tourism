<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user->id)],
            'roles' => ['required', 'array'],
            'roles.*' => ['exists:roles,id'],
        ];

        if ($this->filled('password')) {
            $rules['password'] = ['string', 'min:8', 'confirmed'];
        }

        return $rules;
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
            'password.min' => __('validation.min.string', ['attribute' => __('users.password'), 'min' => 8]),
            'password.confirmed' => __('validation.confirmed', ['attribute' => __('users.password')]),
            'roles.required' => __('validation.required', ['attribute' => __('users.roles')]),
        ];
    }
}
