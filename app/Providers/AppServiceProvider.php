<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Livewire\Livewire;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Auth;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use \CraftForge\FilamentLanguageSwitcher\Events\LocaleChanged;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    //event listener for FilamentLanguageSwitcherPlugin's to update locale in session, user model, and Laravel app
    Event::listen(LocaleChanged::class, function (LocaleChanged $event) {
        
        $newLocale = $event->newLocale;

        // Save to session
        Session::put('locale', $newLocale);

        // Save to user (if logged in)
        if (Auth::check()) {
            Auth::user()->update(['locale' => $newLocale]);
        }

        // Set Laravel app locale
        App::setLocale($newLocale);

        // Set Mcamara / laravel-localization
        LaravelLocalization::setLocale($newLocale);
    });
        Model::unguard();
        Paginator::useTailwind();
        //dd(User::all());

    }
}
