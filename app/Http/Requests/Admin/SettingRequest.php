<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone'       => ['nullable', 'string', 'max:50'],
            'email'       => ['nullable', 'email', 'max:255'],
            'whatsapp'    => ['nullable', 'string', 'max:50'],
            'latitude'    => ['nullable', 'numeric', 'between:-90,90'],
            'longitude'   => ['nullable', 'numeric', 'between:-180,180'],
            'address_en'  => ['nullable', 'string', 'max:255'],
            'address_tr'  => ['nullable', 'string', 'max:255'],
            'address_nl'  => ['nullable', 'string', 'max:255'],
        ];
    }
}
