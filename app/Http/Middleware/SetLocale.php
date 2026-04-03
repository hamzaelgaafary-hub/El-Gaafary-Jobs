<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = Session::get('locale')
        ?? auth::user()?->locale
        ?? config('app.fallback_locale');

        if (in_array($locale, config('filament-localization.locales'))) {
            App::setLocale($locale);
            LaravelLocalization::setLocale($locale); // Mcamara helper
        }

        return $next($request);
    }
}
