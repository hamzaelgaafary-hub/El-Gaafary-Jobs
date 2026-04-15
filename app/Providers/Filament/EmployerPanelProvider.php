<?php

namespace App\Providers\Filament;

use App\Filament\Resources\Employers\Pages\EditEmployer;
use App\Http\Middleware\Checkrole;
use App\Http\Middleware\SetLocale;
use Filament\Navigation\MenuItem;
use CraftForge\FilamentLanguageSwitcher\FilamentLanguageSwitcherPlugin;
use Doriiaan\FilamentAstrotomic\FilamentAstrotomicPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
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
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Filament\Actions\Action;
//use Illuminate\Container\Attributes\Auth;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;


class EmployerPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('Employer')
            ->path('Employer')
            ->default()
            ->login()
            ->authGuard('web')
            // ->profile(EditEmployer::class) 
            ->brandName('El Gaafary Jobs')
            // ->brandLogo(asset('images/logo.svg'))
            ->navigationItems([
                NavigationItem::make('Home Page')
                    ->url('/', shouldOpenInNewTab: false)
                    ->icon('heroicon-o-home')
                    // ->group('روابط سريعة') // اختياري لعمل Heading فوق الرابط
                    ->sort(1),
            ])
            ->userMenuItems([
                'logout' => fn (Action $action) => $action
                    ->label('Log out')
                    ->icon('heroicon-o-arrow-left-on-rectangle')
                    ->color('danger'),
            ])
            
            ->plugins([
                FilamentAstrotomicPlugin::make(),
                // craft plugin setup
                // === LANGUAGE SWITCHER (CORRECTED) ===
                FilamentLanguageSwitcherPlugin::make()
                    ->showOnAuthPages()
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
            ->colors([
                'primary' => Color::Amber,
                'tertiary' => Color::Green,
                'info' => Color::Cyan,
                'success' => Color::Teal,
                'warning' => Color::Orange,
                'danger' => Color::Red,
            ])
            ->discoverResources(in: app_path('Filament/Employer/Resources'), for: 'App\Filament\Employer\Resources')
            ->discoverPages(in: app_path('Filament/Employer/Pages'), for: 'App\Filament\Employer\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Employer/Widgets'), for: 'App\Filament\Employer\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
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
                Checkrole::class.':Employer',

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
