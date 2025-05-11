<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;

class ToastrServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register the toastr component
        Blade::component('toastr', \App\View\Components\Toastr::class);

        // Simply include the toastr component in every AdminLTE page view
        View::composer('adminlte::page', function ($view) {
            // Check if we have scripts section in the view
            if (View::exists('components.toastr')) {
                // Make the toastr_enabled variable available to the view
                $view->with('toastr_enabled', true);
            }
        });
    }
}
