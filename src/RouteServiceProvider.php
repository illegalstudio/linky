<?php

namespace Illegal\Linky;

use Illegal\Linky\Commands\CreateCollectionCommand;
use Illegal\Linky\Commands\CreatePageCommand;
use Illegal\Linky\Commands\CreateLinkCommand;
use Illegal\Linky\Http\Middleware\Authenticate;
use Illegal\Linky\Http\Middleware\EncryptCookies;
use Illegal\Linky\Http\Middleware\RedirectIfAuthenticated;
use Illegal\Linky\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as IlluminateRouteServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends IlluminateRouteServiceProvider
{

    /**
     * The path to the "home" route for the application.
     * Typically, users are redirected here after authentication.
     * @todo Sostituire con una rotta dashboard
     *
     * @var string
     */
    public const HOME = '/linky/admin/links';

    public function boot(): void
    {
        $this->aliasMiddleware('linky-guest', RedirectIfAuthenticated::class);
        $this->aliasMiddleware('linky-auth', Authenticate::class);

        $this->middlewareGroup('linky-web', [
            EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);

        $this->commands([
            CreateCollectionCommand::class,
            CreatePageCommand::class,
            CreateLinkCommand::class
        ]);

        if (config('linky.auth.use_linky_auth') && config('linky.auth.require_valid_user')) {
            Route::middleware('linky-web')
                ->group(__DIR__ . '/../routes/auth.php');
        }

        Route::middleware('linky-web')
            ->group(__DIR__ . '/../routes/web.php');
    }
}
