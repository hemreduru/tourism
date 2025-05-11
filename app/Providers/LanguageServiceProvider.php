<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class LanguageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */    public function boot(): void
    {
        // Share the language configuration with all views
        View::composer('*', function ($view) {
            $view->with('languages', config('languages.available'));
            $view->with('currentLocale', app()->getLocale());
        });

        // Add a language selector to the navbar
        View::composer('adminlte::page', function ($view) {
            // Share the language selector component with the view
            $view->with('languageSelector', view('components.language-selector'));

            // Share the language styles component with the view
            $view->with('languageStyles', view('components.language-styles'));
        });
    }
}
