<?php

namespace App\Providers;

use App\Models\UserPreference;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
     */
    public function boot(): void
    {
        try {
            // AdminLTE'nin konfigürasyon değerlerini değiştir
            config(['adminlte.layout_dark_mode' => false]); // Default değer
            config(['adminlte.classes_sidebar' => 'sidebar-dark-primary elevation-4']); // Default değer
            config(['adminlte.classes_topnav' => 'navbar-white navbar-light']); // Default değer

            // Kullanıcı tercihlerini AdminLTE ayarlarına uygula
            View::composer('adminlte::page', function ($view) {
                if (Auth::check()) {
                    try {
                        $user = Auth::user();
                        $preferences = $user->preferences;

                        // Eğer kullanıcı tercihleri yoksa ve model mevcut değilse, yeni oluştur
                        if (!$preferences) {
                            $defaults = UserPreference::getDefaults();

                            // Kullanıcı için tercih oluştur
                            DB::transaction(function() use ($user, $defaults) {
                                $preferences = new UserPreference($defaults);
                                $preferences->user_id = $user->id;
                                $preferences->save();

                                // User modelini güncelle
                                $user->refresh();
                            });

                            // Hala tercihler yoksa varsayılanları kullan
                            if (!$user->preferences) {
                                $preferences = new UserPreference();
                                $preferences->fill($defaults);
                            } else {
                                $preferences = $user->preferences;
                            }
                        }

                        // AdminLTE body class'ları için array
                        $bodyClasses = [];

                        // Dark mode
                        if ($preferences->dark_mode) {
                            $bodyClasses[] = 'dark-mode';
                            // Konfigürasyonu da güncelle
                            config(['adminlte.layout_dark_mode' => true]);
                        }

                        // Layout options
                        if ($preferences->layout_boxed) {
                            $bodyClasses[] = 'layout-boxed';
                            config(['adminlte.layout_boxed' => true]);
                        }

                        if ($preferences->layout_fixed_sidebar) {
                            $bodyClasses[] = 'layout-fixed';
                            config(['adminlte.layout_fixed_sidebar' => true]);
                        }

                        if ($preferences->layout_fixed_navbar) {
                            $bodyClasses[] = 'layout-navbar-fixed';
                            config(['adminlte.layout_fixed_navbar' => true]);
                        }

                        if ($preferences->layout_fixed_footer) {
                            $bodyClasses[] = 'layout-footer-fixed';
                            config(['adminlte.layout_fixed_footer' => true]);
                        }

                        if ($preferences->sidebar_collapsed) {
                            $bodyClasses[] = 'sidebar-collapse';
                            config(['adminlte.sidebar_collapse' => true]);
                        }

                        // Kenar çubuğu ve üst menü renklerini ayarla
                        config(['adminlte.classes_sidebar' => $preferences->sidebar_color]);
                        config(['adminlte.classes_topnav' => $preferences->navbar_color]);

                        // AdminLTE'ye bu değerleri geçir (fallback olarak)
                        $view->with('admin_lte_body_classes', implode(' ', $bodyClasses));
                        $view->with('classes_sidebar', $preferences->sidebar_color);
                        $view->with('classes_topnav', $preferences->navbar_color);
                    } catch (\Exception $e) {
                        // Hata durumunda loglama yap
                        Log::error('UserPreferences view composer error: ' . $e->getMessage(), [
                            'trace' => $e->getTraceAsString()
                        ]);
                    }
                }
            });
        } catch (\Exception $e) {
            Log::error('ViewServiceProvider boot error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
}
