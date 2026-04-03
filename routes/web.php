<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function() {
    Route::get('/', [JobController::class, 'index']);

    Route::get('/Jobs/create', [JobController::class, 'create'])->middleware('auth');
    Route::post('/Jobs', [JobController::class, 'store'])->middleware('auth');
    Route::get('/Jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
    Route::get('/search', SearchController::class);
    Route::get('/Tags/{Tag:name}', TagController::class);

    Route::middleware('guest')->group(function () {
        Route::get('/register', [RegisteredUserController::class, 'create']);
        Route::post('/register', [RegisteredUserController::class, 'store']);

        Route::get('/login', [SessionController::class, 'create']);
        Route::post('/login', [SessionController::class, 'store']);
    });
    // informational pages
    Route::get('/about', [SiteController::class, 'about']);
    Route::post('/contact', [SiteController::class, 'contact']);
    // directory of employers and their job Seekers
    Route::get('/employers', [SiteController::class, 'directory']);
    Route::get('/employers/{employer}', [SiteController::class, 'show'])->name('employers.show');
    Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');

});