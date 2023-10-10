<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\EditProfile;
use App\Filament\Pages\Auth\Login;
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
            ->login(Login::class)
            ->profile(EditProfile::class)
            ->registration()
            ->colors([
                /*'primary' => Color::Purple,*/

                'primary' => [
                    50=> '#f4f0ff',
                    100 => '#ede4ff',
                    200 => '#dccdff',
                    300 => '#c4a5ff',
                    400 => '#a972ff',
                    500 => '#9139ff',
                    600 => '#8812ff',
                    700 => '#7d00ff',
                    800 => '#6900d7',
                    900 => '#5502ac',
                    950 => '#340078',
                ],
                'gray' => [
                    50 => '#f2ebfc',
                    100 => '#f2ebfc',
                    200 => '#e7dbf9', // Dark [texto do menu inativo - "exibindo 1 a 10 de 50 resultados" na parte inferior da tabela]
                    300 => '#cdb3f2',
                    400 => '#ba94ec', // Dark [texto do brad_crumb - "por página" na paginação]
                    500 => '#9e6be1', // Dark [cor do texto dentro dos inputs, setas de ordenação, setas da bread crumb, icone do menu inativo]
                    600 => '#884cd1',
                    700 => '#333333', // Dark [fundo do toggle]
                    800 => '#623396',
                    900 => '#19062B', // Dark [background da tabela - background do menu superior]
                    950 => '#100222'
                ],
                /*'primary' => '#7025D9',
                'gray' => '#CDB3F2',*/
                /*'info' => '#F1C237',
                'danger' => '#730C0C',
                'success' => '#23AC67',
                'warning' => '#C43A3A',*/
            ])
            ->brandLogo(asset('images/logo-dec-horizontal.png'))
            ->favicon(asset('images/simbolo_dec.png'))
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
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
            ]);
    }
}
