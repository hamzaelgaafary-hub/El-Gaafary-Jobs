<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Pagination\Paginator;
use Mcamara\LaravelLocalization\Traits\LoadsTranslatedCachedRoutes;
//use Illuminate\Foundation\Providers\RouteServiceProvider;
//use BezhanSalleh\LanguageSwitch\LanguageSwitch;


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
        //RouteServiceProvider::loadCachedRoutesUsing(fn() => $this->loadCachedRoutes());
        
        /*
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['ar', 'en']); // تأكد إن اللغات هنا مطابقة لمشروعك
        });
        */
        
        Model::unguard();
        Paginator::useTailwind();
        //dd(User::all());

    }
}
