<?php

namespace App\Providers\Filament;

use App\Models\Setting;

use App\Filament\Pages\Auth\Login;
use App\Filament\Pages\Dashboard;
use App\Filament\Pages\Profile;
use App\Filament\Pages\Settings;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationGroup;
use Filament\Pages\BasePage;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Alignment;
use Filament\Support\Icons\Heroicon;
use Filament\View\PanelsRenderHook;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;

use DiogoGPinto\AuthUIEnhancer\AuthUIEnhancerPlugin;
use CraftForge\FilamentLanguageSwitcher\FilamentLanguageSwitcherPlugin;
use AzGasim\FilamentUnsavedChangesModal\FilamentUnsavedChangesModalPlugin;
use Moataz01\FilamentNotificationSound\FilamentNotificationSoundPlugin;
use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;

class DashboardPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $setting = null;

        if (
            ! app()->runningInConsole() &&
            Schema::hasTable('settings')
        ) {
            $setting = Setting::first();
        }

        $themeColor = $setting?->app_color ?? '#00ff91';

        // Set form actions alignment to the end (right side)
        BasePage::formActionsAlignment(Alignment::End);

        return $panel
            ->default()
            ->id('dashboard')
            ->path('/pipspanel')
            ->databaseNotifications()
            ->viteTheme('resources/css/filament/dashboard/theme.css')
            ->login(Login::class)
            ->favicon(safe_image_url($setting?->app_favicon))
            ->brandLogo(fn () => view('filament.components.brand-logo', [
                'setting' => $setting,
            ]))
            // ->brandLogoHeight('2rem')
            ->colors([
                'primary' => Color::hex($themeColor),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->plugins([
                AuthUIEnhancerPlugin::make()
                    ->showEmptyPanelOnMobile(false)
                    ->formPanelPosition('right')
                    ->formPanelWidth('30%')
                    ->emptyPanelBackgroundImageOpacity('80%')
                    ->emptyPanelBackgroundImageUrl(safe_image_url($setting?->app_background_login_image)),
            ])
            ->navigationGroups([
                NavigationGroup::make('User Management')
                    ->icon('heroicon-o-user-group'),
                NavigationGroup::make('Master Data')
                    ->icon('heroicon-o-circle-stack'),
                NavigationGroup::make('System')
                    ->icon('heroicon-o-cog-6-tooth'),
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('Profile')
                    ->url(fn (): string => Profile::getUrl())
                    ->icon(Heroicon::OutlinedUser),
                MenuItem::make()
                    ->label('Settings')
                    ->url(fn (): string => Settings::getUrl())
                    ->icon(Heroicon::OutlinedCog6Tooth)
                    ->visible(fn () => auth()->user()->can('ViewAny', Setting::class)),
            ])
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
            ])
            ->authMiddleware([
                Authenticate::class,
            ])

            // Plugins
            ->unsavedChangesAlerts()
            ->plugins([
                AuthUIEnhancerPlugin::make()
                    ->showEmptyPanelOnMobile(false)
                    ->formPanelPosition('right')
                    ->formPanelWidth('50%')
                    ->emptyPanelBackgroundImageOpacity('80%')
                    ->emptyPanelBackgroundImageUrl(safe_image_url($setting?->app_background_login_image)),
                FilamentUnsavedChangesModalPlugin::make(),
                FilamentNotificationSoundPlugin::make(),
                FilamentLanguageSwitcherPlugin::make()
                    ->locales([
                        ['code' => 'id', 'name' => 'Indonesia', 'flag' => 'id'],
                        ['code' => 'en', 'name' => 'English', 'flag' => 'us'],
                    ]),
            ])
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): HtmlString => new HtmlString(
                    request()->routeIs('filament.dashboard.auth.*')
                        ? RecaptchaV3::initJs()
                        : ''
                )
            )
            ->renderHook(
                PanelsRenderHook::AUTH_LOGIN_FORM_AFTER,
                fn (): HtmlString => new HtmlString(
                    view('filament.components.social-links', [
                        'setting' => Setting::query()->first(),
                    ])->render()
                )
            )
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): HtmlString => new HtmlString('
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
                    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
                ')
            );
    }
}
