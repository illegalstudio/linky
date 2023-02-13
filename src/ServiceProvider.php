<?php

namespace Illegal\Linky;

use Illegal\Linky\Http\Livewire\LinkList;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Livewire\Livewire;

class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        /**
         * Linky config file
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

        /**
         * LiveWire components
         */
        Livewire::component('linky::link-list', LinkList::class);
    }
}
