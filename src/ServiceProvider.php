<?php

namespace Illegal\Linky;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        /**
         * Bennu config file
         */
        $this->mergeConfigFrom(__DIR__ . "/../config/linky.php", "linky");
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'linky');
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'linky');

        $this->loadMigrationsFrom([
            __DIR__ . '/../database/migrations/'
        ]);
    }
}
