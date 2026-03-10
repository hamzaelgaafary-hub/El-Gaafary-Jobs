<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Pagination\Paginator;
use Mcamara\LaravelLocalization\Traits\LoadsTranslatedCachedRoutes;
//use Illuminate\Foundation\Providers\RouteServiceProvider;


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

        Model::unguard();
        Paginator::useTailwind();
        //dd(User::all());

    }
}
