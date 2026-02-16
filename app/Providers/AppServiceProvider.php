<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
=======
use App\Models\User;
use App\Observers\UserObserver;
>>>>>>> 328b122 (First commit from New pulled version)

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
        
        Model::unguard();
<<<<<<< HEAD
=======
        
        User::observe(UserObserver::class);

>>>>>>> 328b122 (First commit from New pulled version)
    }
}
