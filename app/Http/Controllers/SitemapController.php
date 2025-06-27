<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Response;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Service;
use App\Models\Partner;

class SitemapController extends Controller
{
    /**
     * Generate sitemap dynamically using spatie/laravel-sitemap
     */
    public function index(): Response
    {
        // Available languages (fallback if config missing)
        $languages = config('languages.available', [
            'en' => 'English',
            'tr' => 'Türkçe',
            'nl' => 'Nederlands',
        ]);

        $now = Carbon::now();

        $sitemap = Sitemap::create();

        // Helper to add alternates
        $addAlternates = function (Url $url, string $path) use ($languages) {
            foreach ($languages as $locale => $label) {
                if ($locale === 'en') {
                    continue;
                }
                $localizedPath = $path === '/'
                    ? "/language/{$locale}"
                    : "/language/{$locale}{$path}";
                $url->addAlternate(url($localizedPath), $locale);
            }
        };

        // Static pages metadata using route names for robustness
        $staticPages = [
            ['route' => 'home',           'path' => '/',          'freq' => 'weekly',  'prio' => 1.0],
            ['route' => 'theme.about',    'path' => '/about',     'freq' => 'monthly', 'prio' => 0.8],
            ['route' => 'theme.services', 'path' => '/services',  'freq' => 'weekly',  'prio' => 0.8],
            ['route' => 'theme.partners', 'path' => '/partners',  'freq' => 'weekly',  'prio' => 0.7],
            ['route' => 'theme.contact',  'path' => '/contact',   'freq' => 'monthly', 'prio' => 0.7],
        ];

        foreach ($staticPages as $page) {
            $url = Url::create(route($page['route']))
                ->setChangeFrequency($page['freq'])
                ->setPriority($page['prio'])
                ->setLastModificationDate($now);
            $addAlternates($url, $page['path']);
            $sitemap->add($url);
        }

        // Services
        $services = Service::where('is_active', 1)->get();
        foreach ($services as $service) {
            $basePath = "/services/{$service->id}"; // for alternate links
            $url = Url::create(route('theme.service', ['service' => $service->id]))
                ->setChangeFrequency('weekly')
                ->setPriority(0.6)
                ->setLastModificationDate($service->updated_at ?? $now);
            $addAlternates($url, $basePath);
            $sitemap->add($url);
        }

        // Partners
        $partners = Partner::where('is_active', 1)->get();
        foreach ($partners as $partner) {
            $basePath = "/partners/{$partner->id}";
            $url = Url::create(route('theme.partner', ['partner' => $partner->id]))
                ->setChangeFrequency('weekly')
                ->setPriority(0.6)
                ->setLastModificationDate($partner->updated_at ?? $now);
            $addAlternates($url, $basePath);
            $sitemap->add($url);
        }

        return response($sitemap->render(), 200)
            ->header('Content-Type', 'application/xml');
    }
}
