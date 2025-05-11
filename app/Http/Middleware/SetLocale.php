<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */    public function handle(Request $request, Closure $next)
    {
        if (Session::has('locale')) {
            // Set the application locale to the one stored in the session
            App::setLocale(Session::get('locale'));
        } else {
            // Use the default locale from the config
            $defaultLocale = config('languages.default', config('app.locale'));
            App::setLocale($defaultLocale);
            Session::put('locale', $defaultLocale);
        }

        return $next($request);
    }
}
