<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use App\Models\Service;
use App\Models\Partner;
use Carbon\Carbon;

class SitemapController extends Controller
{
    /**
     * Sitemap'i dinamik olarak oluşturur
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $content = view('sitemap.index', [
            'services' => Service::where('status', 1)->get(),
            'partners' => Partner::where('status', 1)->get(),
            'languages' => config('languages.available'),
        ])->render();

        return response($content, 200)
            ->header('Content-Type', 'text/xml');
    }
}
