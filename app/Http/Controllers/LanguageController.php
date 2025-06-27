<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Helpers\LogHelper;

class LanguageController extends Controller
{
    /**
     * Set the application language.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $locale
     * @return \Illuminate\Http\RedirectResponse
     */    public function switchLang(Request $request, $locale)
    {
        // Check if the locale is valid and available
        $availableLanguages = config('languages.available', ['en' => []]);
        $oldLocale = Session::get('locale', config('languages.default', 'nl'));

        if (array_key_exists($locale, $availableLanguages)) {
            // Store the locale in the session
            Session::put('locale', $locale);

            // Log language switch using LogHelper
            LogHelper::logDbOperation(
                'update',
                'UserLanguage',
                [
                    'old_locale' => $oldLocale,
                    'new_locale' => $locale,
                    'ip' => $request->ip()
                ]
            );
        }

        // Redirect back to the previous page
        return redirect()->back();
    }
}
