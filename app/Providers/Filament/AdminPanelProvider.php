<?php

namespace App\Providers\Filament;

use App\Http\Middleware\Checkrole;
use App\Http\Middleware\SetLocale;
use CraftForge\FilamentLanguageSwitcher\FilamentLanguageSwitcherPlugin;
use Doriiaan\FilamentAstrotomic\FilamentAstrotomicPlugin;
use Filament\Actions\Action;
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
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;


class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('Admin')
            ->path('Admin')
            ->login()
            
            ->authGuard('web')
            ->font('Tajawal')
            ->brandName('El Gaafary Jobs')
            // ->brandLogo(asset('images/logo.svg'))
            ->plugins([
                FilamentAstrotomicPlugin::make(),
                // craft plugin setup
                // === LANGUAGE SWITCHER (CORRECTED) ===
                FilamentLanguageSwitcherPlugin::make()
                    // ->showOnAuthPages()
                    ->locales([
                        ['code' => 'en', 'name' => 'English',     'flag' => 'gb'],
                        ['code' => 'ar', 'name' => 'العربية',    'flag' => 'eg'],
                        ['code' => 'tr', 'name' => 'Türkçe',    'flag' => 'tr'],
                        // add more as needed
                    ])
                    ->showFlags(true)
                    ->rememberLocale(days: 30),
                // craft plugin setup end
            ])
            ->userMenuItems([
                'logout' => fn (Action $action) => $action
                    ->label('Log out')
                    ->icon('heroicon-o-arrow-left-on-rectangle')
                    ->color('danger'),
            ])
            ->colors([
                'primary' => Color::Blue,
                'tertiary' => Color::Green,
                'info' => Color::Cyan,
                'success' => Color::Teal,
                'warning' => Color::Orange,
                'danger' => Color::Red,
            ])
            // ->registration()
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

                SetLocale::class,
                LocaleSessionRedirect::class,
                LaravelLocalizationRoutes::class,
                LaravelLocalizationViewPath::class,

            ])

            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
