<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class Recaptcha implements Rule
{
    public function passes($attribute, $value)
    {
        $secret = config('services.recaptcha.secret');
        if (!$secret) {
            // Allow validation if secret missing to avoid blocking form in dev.
            return true;
        }
        try {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret'   => $secret,
                'response' => $value,
                'remoteip' => request()->ip(),
            ]);
            return optional($response->json())['success'] ?? false;
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function message()
    {
        return __('validation.recaptcha');
    }
}
