<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $defaultLocale = config('app.locale', 'en');

        $locale = $defaultLocale;

        // dd($request->session()->get('locale'));
        // dd($request->cookie('filament_language_switcher_locale'));
        // dd($request->cookie('locale'));
        // dd($defaultLocale);

        if ($request->hasSession()) {
            $locale = $request->session()->get('locale', $defaultLocale);

            if (! $locale) {
                $locale = $request->cookie('filament_language_switcher_locale')
                    ?: $request->cookie('locale')
                    ?: $defaultLocale;

                $request->session()->put('locale', $locale);
            }
        } else {
            $locale = $request->cookie('filament_language_switcher_locale')
                ?: $request->cookie('locale')
                ?: $defaultLocale;
        }

        $supportedLocales = config('filament-localization.locales', ['en', 'ar', 'tr']);

        if (! in_array($locale, $supportedLocales, true)) {
            $locale = config('app.fallback_locale', $defaultLocale);
        }
        // dd($defaultLocale);

        App::setLocale($locale);

        if (class_exists(LaravelLocalization::class)) {
            LaravelLocalization::setLocale($locale);
        }
        // dd($locale);

        $request->session()?->put('locale', $locale);

        return $next($request);
    }
}
