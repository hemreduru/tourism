<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FaqUpdateRequest extends FormRequest
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
            'question_en' => ['required', 'string', 'max:255'],
            'question_tr' => ['required', 'string', 'max:255'],
            'question_nl' => ['required', 'string', 'max:255'],
            'answer_en' => ['required', 'string'],
            'answer_tr' => ['required', 'string'],
            'answer_nl' => ['required', 'string'],
            'order' => ['required', 'integer', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
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
            'question_en' => 'Question (English)',
            'question_tr' => 'Soru (Türkçe)',
            'question_nl' => 'Vraag (Nederlands)',
            'answer_en' => 'Answer (English)',
            'answer_tr' => 'Cevap (Türkçe)',
            'answer_nl' => 'Antwoord (Nederlands)',
            'order' => 'Sıra',
            'is_active' => 'Aktif/Pasif',
        ];
    }
}
