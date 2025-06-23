<?php

namespace App\Services\Menu;

use Illuminate\Support\Facades\Auth;

/**
 * Application Menu Management Class
 */
class ApplicationMenu
{
    /**
     * Get the entire application menu structure
     *
     * @return array
     */
    public function getItems(): array
    {
        // menu-item-dropdown-user-menu.blade.php for user dropdown menu
        $items = [
            $this->item(__('adminlte::menu.admin_dashboard'), 'admin/dashboard', 'fas fa-chart-pie', [], null, null),
            $this->item(__('adminlte.content_management'), null, 'fas fa-file-alt', [
                $this->item(__('adminlte.about_us_management'), 'admin/about-us', 'fas fa-info-circle', [], null, ['about_us.view']),
                $this->item(__('services.services'), 'admin/services', 'fas fa-concierge-bell', [], null, ['services.view']),
                $this->item(__('partners.partners'), 'admin/partners', 'fas fa-handshake', [], null, ['partners.view']),
                $this->item(__('gallery.galleries'), 'admin/galleries', 'fas fa-images', [], null, ['galleries.view']),
                $this->item(__('testimonials.testimonials'), 'admin/testimonials', 'fas fa-comment-dots', [], null, ['testimonials.view']),
                $this->item(__('contacts.contacts'), 'admin/contacts', 'fas fa-envelope', [], null, ['contacts.view']),
                $this->item(__('policies.policies'), 'admin/policies', 'fas fa-shield-alt', [], null, ['policies.view']),
                $this->item(__('settings.settings'), 'admin/settings', 'fas fa-cog', [], null, ['settings.edit']),
            ]),
            $this->item(__('adminlte::menu.user_management'), null, 'fas fa-users', [
                $this->item(__('adminlte::menu.users'), 'admin/users', 'fas fa-user-friends', [], null, ['users.view']),
                $this->item(__('adminlte::menu.roles'), 'admin/roles', 'fas fa-user-tag', [], null, ['roles.view']),
                $this->item(__('adminlte::menu.permissions'), 'admin/permissions', 'fas fa-key', [], null, ['permissions.view']),
            ]),


        ];

        // Add Telescope menu item for admin role only
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            $items[] = [
                'text' => 'System Monitoring',
                'url'  => 'telescope',
                'icon' => 'fas fa-chart-line',
                'icon_color' => 'orange',
                'target' => '_blank',
            ];
        }

        return $items;
    }


    /**
     * Create a menu item with role check
     *
     * @param string $text Text to display
     * @param string|null $url URL for the menu item
     * @param string|null $icon Icon class
     * @param array $submenu Submenu items
     * @param string|array|null $roles Role or roles required to see this item
     * @return array
     */
    /**
     * Create a menu item with role and/or permission check
     *
     * @param string $text Text to display
     * @param string|null $url URL for the menu item
     * @param string|null $icon Icon class
     * @param array $submenu Submenu items
     * @param string|array|null $roles Role or roles required to see this item
     * @param string|array|null $permissions Permission or permissions required to see this item
     * @return array
     */
    protected function item(string $text, ?string $url = null, ?string $icon = null, array $submenu = [], $roles = null, $permissions = null): array
    {
        $item = [
            'text' => $text,
        ];

        if ($url) {
            $item['url'] = $url;
        }

        if ($icon) {
            $item['icon'] = $icon;
        }

        if (!empty($submenu)) {
            $item['submenu'] = $submenu;
        }

        if ($roles) {
            $item['roles'] = is_array($roles) ? $roles : [$roles];
        }

        if ($permissions) {
            $item['permissions'] = is_array($permissions) ? $permissions : [$permissions];
        }

        return $item;
    }

    /**
     * Create a header item (non-clickable text separator) with optional role/permission check
     *
     * @param string $text The header text
     * @param string|array|null $roles Role or roles required to see this header
     * @param string|array|null $permissions Permission or permissions required to see this header
     * @return array
     */
    protected function header(string $text, $roles = null, $permissions = null): array
    {
        $header = [
            'header' => $text
        ];

        if ($roles) {
            $header['roles'] = is_array($roles) ? $roles : [$roles];
        }

        if ($permissions) {
            $header['permissions'] = is_array($permissions) ? $permissions : [$permissions];
        }

        return $header;
    }

    /**
     * Get user dropdown menu items
     *
     * @return array
     */
    public function getUserDropdownItems(): array
    {
        return [
            [
                'text' => __('adminlte::menu.profile'),
                'url'  => '#',
                'icon' => 'fas fa-fw fa-user',
            ],
            [
                'text' => __('adminlte::menu.logout'),
                'url'  => 'logout',
                'icon' => 'fas fa-fw fa-sign-out-alt',
            ],
        ];
    }
}
