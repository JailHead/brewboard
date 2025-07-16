<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => [
                    50 => '#f6f7f4',
                    100 => '#e4e6c3',
                    200 => '#d4d7a8',
                    300 => '#b8bc8a',
                    400 => '#9ca272',
                    500 => '#677c5b', // Primary
                    600 => '#5a6d50',
                    700 => '#4d5e45',
                    800 => '#40503a',
                    900 => '#2f3036', // Primary off
                    950 => '#1f2127',
                ],
                'gray' => [
                    50 => '#fafaf9',
                    100 => '#efe9db', // Secondary 01
                    200 => '#e4dccf',
                    300 => '#d5c9b5',
                    400 => '#afa288', // Secondary 02
                    500 => '#988b71', // Secondary 03
                    600 => '#80735b', // Secondary 04
                    700 => '#685c44', // Secondary 05
                    800 => '#544934',
                    900 => '#3d3426',
                    950 => '#2a221a',
                ],
                'success' => Color::Green,
                'warning' => Color::Amber,
                'danger' => Color::Red,
                'info' => Color::Blue,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                \App\Filament\Widgets\EmployeesByRoleChart::class,
                \App\Filament\Widgets\AdminCountAlert::class,
                \App\Filament\Widgets\StatsOverview::class,
                Widgets\AccountWidget::class,
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
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->brandName('BrewBoard Admin')
            ->favicon(asset('images/favicon.ico'));
    }
}