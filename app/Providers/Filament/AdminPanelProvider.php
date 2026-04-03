<?php

namespace App\Providers\Filament;

use App\Http\Middleware\Checkrole;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Doriiaan\FilamentAstrotomic\FilamentAstrotomicPlugin;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath;
use Illuminate\Support\Facades\Auth;
use CraftForge\FilamentLanguageSwitcher\FilamentLanguageSwitcherPlugin;
use App\Models\User;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Route;
use Filament\Actions\Action;
use Illuminate\Support\Facades\App;
use Filament\View\PanelsRenderHook;
use Filament\Navigation\MenuItem;
use App\Http\Middleware\SetLocale;


class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('Admin')
            ->path('Admin')

            ->login()
            /*
            FilamentLanguageSwitcherPlugin::make()
                ->locales([
                    ['code' => 'en', 'name' => 'English', 'flag' => 'gb'],
                    ['code' => 'ar', 'name' => 'Arabic', 'flag' => 'ar'],
            ])
            
            ->bootUsing(function () {
                // Sync Filament's locale with mcamara's detected locale
                $locale = session('locale', config('app.locale'));
                App::setLocale($locale);
            })
            */
            
            ->font('Tajawal')
            ->plugins([
           FilamentAstrotomicPlugin::make(),

            // === LANGUAGE SWITCHER (CORRECTED) ===
            FilamentLanguageSwitcherPlugin::make()
                ->locales([
                    ['code' => 'en', 'name' => 'English',     'flag' => 'gb'],
                    ['code' => 'ar', 'name' => 'العربية',    'flag' => 'eg'],
                    ['code' => 'tr', 'name' => 'Türkçe',    'flag' => 'tr'],
                    // add more as needed
                ])
                ->showFlags(true)        
                            // default = true, you can remove this line
                ->renderHook(PanelsRenderHook::TOPBAR_END)   // ← Best UX for job portal (top-right)
                // Other popular positions:
                ->renderHook(PanelsRenderHook::USER_MENU_BEFORE)     // default
                //->renderHook(PanelsRenderHook::SIDEBAR_FOOTER)
                ->rememberLocale(days: 30),
            ])
            
            ->colors([
                'primary' => Color::Blue,
                'tertiary' => Color::Green,
                'info' => Color::Cyan,
                'success' => Color::Teal,
                'warning' => Color::Orange,
                'danger' => Color::Red,
            ])
            ->registration()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                // AccountWidget::class,
                // FilamentInfoWidget::class,
            ])
            ->middleware([
                SetLocale::class,
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                Checkrole::class.':Admin',
                LocaleSessionRedirect::class,
                LaravelLocalizationRoutes::class,
                LaravelLocalizationViewPath::class,
            ])
            
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
