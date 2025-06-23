<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use App\Models\Service; // Added for header dropdown
use App\Models\Partner; // Added for header dropdown
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('path.public', function () {
            return base_path('../public_html');
        });
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

        // Share global settings with all views if table exists (avoids error during first migration)
        $shared = null;
        if (Schema::hasTable('settings')) {
            $shared = Setting::first();
        }
        if (!$shared) {
            $shared = new Setting(); // empty model to avoid null reference in blades
        }
        view()->share('setting', $shared);

        // Share services and partners for header dropdowns
        if (Schema::hasTable('services')) {
            $headerServices = Service::where('is_active', 1)->orderBy('order')->get();
            view()->share('headerServices', $headerServices);
        }

        if (Schema::hasTable('partners')) {
            $headerPartners = Partner::where('is_active', 1)->orderBy('order')->get();
            view()->share('headerPartners', $headerPartners);
        }

        // Toastr component registration moved to ToastrServiceProvider
    }
}
