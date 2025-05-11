<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Config;

class AdminLTEServiceProvider extends ServiceProvider
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
        // Apply dark mode preference from cookie (default to off if not set)
        $darkMode = Cookie::get('dark_mode', 'off') === 'on';

        // Set AdminLTE dark mode configuration
        Config::set('adminlte.layout_dark_mode', $darkMode);

        // Update sidebar and body classes
        if ($darkMode) {
            Config::set('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4');
            Config::set('adminlte.classes_body', 'dark-mode');
        } else {
            Config::set('adminlte.classes_sidebar', 'sidebar-light-primary elevation-4');
            Config::set('adminlte.classes_body', '');
        }

        // Update color scheme for navbar
        if ($darkMode) {
            Config::set('adminlte.classes_topnav', 'navbar-dark');
        } else {
            Config::set('adminlte.classes_topnav', 'navbar-white navbar-light');
        }
    }
}
