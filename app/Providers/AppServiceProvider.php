<?php

namespace App\Providers;

use App\Filament\EmployerJobs\Pages\Auth\LogoutResponse;
use Filament\Auth\Http\Responses\Contracts\LogoutResponse as LogoutResponseContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use CraftForge\FilamentLanguageSwitcher\Events\LocaleChanged;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LogoutResponseContract::class, LogoutResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /* craft plugin setup */
        // event listener for FilamentLanguageSwitcherPlugin's to update locale in session, user model, and Laravel app
        Event::listen(LocaleChanged::class, function (LocaleChanged $event) {

            $newLocale = $event->newLocale;
            // dd($event, $newLocale);

            // Save to session
            Session::put('locale', $newLocale);

            // Save to user (if logged in)
            if (Auth::check()) {
                Auth::user()->update(['locale' => $newLocale]);
            }
            // dd($newLocale);

            // Set Laravel app locale
            App::setLocale($newLocale);

            // Set Mcamara / laravel-localization
            LaravelLocalization::setLocale($newLocale);
            // dd('Locale changed to: '.$newLocale);

        });

        // ////// craft plugin setup end
        // Model::unguard();
        Paginator::useTailwind();

    }
}
