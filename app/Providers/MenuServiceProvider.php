<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use App\Services\Menu\ApplicationMenu;
use Illuminate\Support\Facades\Auth;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register a custom menu filter for Laratrust roles and permissions
        $this->app->bind('adminlte.menu.filter.laratrust', function ($app) {
            return new class implements FilterInterface {
                public function transform($item) {
                    $hasAccess = false;

                    // Skip access check if no restrictions
                    if (!isset($item['roles']) && !isset($item['permissions'])) {
                        return $item;
                    }

                    if (Auth::check()) {
                        // Check if item has permissions restriction
                        if (isset($item['permissions'])) {
                            foreach ($item['permissions'] as $permission) {
                                if (Auth::user()->hasPermission($permission)) {
                                    $hasAccess = true;
                                    break;
                                }
                            }
                        }

                        // If permissions check failed or no permissions specified, check roles
                        if (!$hasAccess && isset($item['roles'])) {
                            foreach ($item['roles'] as $roleName) {
                                if (Auth::user()->hasRole($roleName)) {
                                    $hasAccess = true;
                                    break;
                                }
                            }
                        }
                    }

                    // If user doesn't have required access, hide the item
                    if (!$hasAccess && (isset($item['roles']) || isset($item['permissions']))) {
                        $item['restricted'] = true;
                    }

                    // Remove restriction keys to avoid conflicts with AdminLTE's own filters
                    unset($item['roles']);
                    unset($item['permissions']);

                    return $item;
                }
            };
        });

        // Not needed anymore as we already added it in the config file
        // $this->app->config->push('adminlte.filters', 'adminlte.menu.filter.laratrust');
    }

    /**
     * Bootstrap services.
     */
    public function boot(Dispatcher $events): void
    {
        // Use custom view for user menu items
        view()->composer('vendor.adminlte.partials.navbar.menu-item-dropdown-user-menu', function ($view) {
            $applicationMenu = new ApplicationMenu();
            $view->with('userDropdownMenu', $applicationMenu->getUserDropdownItems());
        });

        // Add menu items from ApplicationMenu
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $applicationMenu = new ApplicationMenu();

            // Add each menu item from the ApplicationMenu class
            foreach ($applicationMenu->getItems() as $item) {
                $event->menu->add($item);
            }
        });
    }
}
