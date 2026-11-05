<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Dashboard;
use App\Filament\Pages\GantiPassword;
use App\Filament\Widgets\AdminOverview;
use App\Filament\Widgets\StudentDistribution;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
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
                'primary' => Color::Amber,
            ])
            // Menggunakan tampilan kustom agar logo dan teks berdampingan rapi
            ->brandLogo(fn () => view('filament.admin.logo'))
            ->brandLogoHeight('2.5rem')
            ->userMenuItems([
                MenuItem::make()
                    ->label('Change Password')
                    ->url(fn (): string => GantiPassword::getUrl())
                    ->icon('heroicon-m-key'),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                AdminOverview::class,
                StudentDistribution::class,
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
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): string => '<style>
                    body, .fi-body {
                        font-family: "Plus Jakarta Sans", "Poppins", sans-serif !important;
                        background-color: #f8fafc !important;
                    }
                    .fi-input-wrp {
                        border: 1px solid #cbd5e1 !important;
                        border-radius: 0.5rem !important;
                        background-color: #ffffff !important;
                    }
                    .fi-input-wrp:focus-within {
                        border-color: #ffc72c !important;
                        box-shadow: 0 0 0 2px rgba(255, 199, 44, 0.2) !important;
                    }
                    /* Styling border untuk checkbox Remember Me */
                    .fi-checkbox-input {
                        border: 1px solid #cbd5e1 !important;
                        border-radius: 0.25rem !important;
                        background-color: #ffffff !important;
                    }
                    .fi-checkbox-input:checked {
                        background-color: #ffc72c !important;
                        border-color: #ffc72c !important;
                    }
                    *, *:focus, *:focus-visible, [tabindex="-1"]:focus {
                        outline: none !important;
                        --tw-ring-color: transparent !important;
                        --tw-ring-shadow: none !important;
                        --tw-ring-offset-width: 0px !important;
                    }
                    .fi-topbar, .fi-topbar nav {
                        background-color: #ffc72c !important;
                        border-bottom: none !important;
                    }
                    .fi-user-menu button, .fi-topbar .fi-dropdown-trigger {
                        color: #000000 !important;
                        font-weight: 700 !important;
                    }
                    .fi-sidebar {
                        background-color: #ffffff !important;
                        border-right: 1px solid #e5e7eb !important;
                        width: 16rem !important;
                    }
                    .fi-sidebar-header {
                        padding: 1.5rem 1rem !important;
                    }
                    .fi-sidebar-header a, .fi-sidebar-header span {
                        font-size: 1.1rem !important;
                        font-weight: 900 !important;
                        color: #000000 !important;
                        letter-spacing: -0.025em !important;
                    }
                    .fi-sidebar-group {
                        padding: 0 !important;
                        margin: 0 !important;
                    }
                    .fi-sidebar-group-button,
                    button.fi-sidebar-group-button,
                    .fi-sidebar-group-label,
                    .fi-sidebar-group-label span {
                        display: flex !important;
                        flex-direction: row !important;
                        align-items: center !important;
                        justify-content: space-between !important;
                        width: 100% !important;
                        padding: 0.75rem 1.25rem !important;
                        margin: 0.5rem 0 !important;
                        box-sizing: border-box !important;
                    }
                    .fi-sidebar-group-button span,
                    .fi-sidebar-group-label span,
                    .fi-sidebar-group-label,
                    .fi-sidebar-group-button {
                        font-weight: 900 !important;
                        color: #000000 !important;
                        text-transform: uppercase !important;
                        font-size: 0.75rem !important;
                        letter-spacing: 0.05em !important;
                        line-height: 1 !important;
                    }
                    .fi-sidebar-group-button svg,
                    .fi-sidebar-group-label svg {
                        color: #000000 !important;
                        width: 1.25rem !important;
                        height: 1.25rem !important;
                        margin: 0 !important;
                        flex-shrink: 0 !important;
                    }
                    .fi-sidebar-item a,
                    .fi-sidebar-nav-item a {
                        border-radius: 0.5rem !important;
                        margin: 0.25rem 0.5rem !important;
                        padding: 0.625rem 1rem !important;
                        font-weight: 700 !important;
                        color: #000000 !important;
                        transition: all 0.2s ease !important;
                    }
                    .fi-sidebar-item-active,
                    .fi-sidebar-item-active > a,
                    .fi-sidebar-item-active a,
                    .fi-sidebar-nav-item-active,
                    .fi-sidebar-nav-item-active a,
                    .fi-sidebar-item[aria-current="page"],
                    .fi-sidebar-item[aria-current="page"] > a,
                    .fi-sidebar-item a[aria-current="page"] {
                        background-color: #ffc72c !important;
                        color: #000000 !important;
                        border-radius: 0.5rem !important;
                    }
                    .fi-sidebar-item-active *,
                    .fi-sidebar-nav-item-active *,
                    .fi-sidebar-item[aria-current="page"] * {
                        color: #000000 !important;
                    }
                    .fi-sidebar-item a:hover,
                    .fi-sidebar-nav-item a:hover {
                        background-color: #ffe082 !important;
                        color: #000000 !important;
                    }
                    .fi-sidebar-nav-item svg,
                    .fi-sidebar-item svg {
                        color: #000000 !important;
                        width: 1.25rem !important;
                        height: 1.25rem !important;
                    }
                    .fi-wi-stats-overview-stat,
                    .fi-wi-widget > div,
                    .fi-section {
                        background-color: #ffffff !important;
                        border: 1px solid #e5e7eb !important;
                        border-radius: 0.875rem !important;
                        box-shadow: none !important;
                    }
                </style>'
            );
    }
}