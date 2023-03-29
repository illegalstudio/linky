<?php

namespace Illegal\Linky;

use Illegal\Linky\Commands\CreateCollectionCommand;
use Illegal\Linky\Commands\CreateLinkCommand;
use Illegal\Linky\Commands\CreatePageCommand;
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
        $this->commands([
            CreateCollectionCommand::class,
            CreatePageCommand::class,
            CreateLinkCommand::class
        ]);

        Route::middleware(LinkyAuth::webMiddleware())
            ->group(__DIR__ . '/../routes/web.php');
    }
}
