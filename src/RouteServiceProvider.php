<?php

namespace Illegal\Linky;

use Illegal\Linky\Commands\CreateRedirectCommand;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as IlluminateRouteServiceProvider;

class RouteServiceProvider extends IlluminateRouteServiceProvider
{

    public function boot(): void
    {
        $this->commands([
            CreateRedirectCommand::class
        ]);
    }
}
