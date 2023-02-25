<?php

namespace Illegal\Linky;

use Blade;
use File;
use Illegal\Linky\Http\Livewire\CollectionContentManager;
use Illegal\Linky\Http\Livewire\CollectionList;
use Illegal\Linky\Http\Livewire\LinkList;
use Illegal\Linky\Http\Livewire\PageList;
use Illegal\Linky\Models\PersonalAccessToken;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Laravel\Sanctum\Sanctum;
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

        /**
         * Load authentication config file.
         * If the system is using linky authentication, we will use the linky auth config file, backing up the original.
         * Otherwise, we will restore the original config file.
         */
        if(config('linky.auth.use_linky_auth')) {
            if(File::exists(base_path() . "/config/auth.php")) {
                File::move(base_path() . "/config/auth.php", base_path() . "/config/auth.php.linky");
            }
            $this->mergeConfigFrom(__DIR__ . "/../config/auth.php", "auth");
        } else {
            if(File::exists(base_path() . "/config/auth.php.linky")) {
                File::move(base_path() . "/config/auth.php.linky", base_path() . "/config/auth.php");
            }
        }
    }

    /**
     * @return void
     */
    public function boot(): void
    {

        /**
         * Replace the sanctum personal access token model with the linky version if linky auth is enabled.
         */
        if(config('linky.auth.use_linky_auth')) {
            Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'linky');
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'linky');

        $this->loadMigrationsFrom([
            __DIR__ . '/../database/migrations/'
        ]);

        /**
         * Blade components
         */
        Blade::componentNamespace('Illegal\\Linky\\View\\Components', 'linky');

        /**
         * LiveWire components
         */
        Livewire::component('linky::link-list', LinkList::class);
        Livewire::component('linky::collection-list', CollectionList::class);
        Livewire::component('linky::collection-content-manager', CollectionContentManager::class);
        Livewire::component('linky::page-list', PageList::class);
    }
}
