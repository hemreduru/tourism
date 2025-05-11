<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Redirect to dashboard if profile routes are accessed
        if (request()->is('profile*')) {
            abort(redirect()->route('admin.dashboard'));
        }

        // Toastr component registration moved to ToastrServiceProvider
    }
}
