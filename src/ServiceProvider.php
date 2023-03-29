<?php

namespace Illegal\Linky;

use Exception;
use Illegal\InsideAuth\InsideAuth;
use Illegal\InsideAuth\Models\PersonalAccessToken;
use Illegal\Linky\Auth\Authentication;
use Illegal\Linky\Http\Livewire\CollectionContentManager;
use Illegal\Linky\Http\Livewire\CollectionList;
use Illegal\Linky\Http\Livewire\LinkList;
use Illegal\Linky\Http\Livewire\PageList;
use Illegal\Linky\Repositories\CollectionRepository;
use Illegal\Linky\Repositories\ContentRepository;
use Illegal\Linky\Repositories\HitRepository;
use Illegal\Linky\Repositories\LinkRepository;
use Illegal\Linky\Repositories\PageRepository;
use Illegal\Linky\Services\SlugGenerator;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Laravel\Sanctum\Sanctum;
use Livewire\Livewire;

class ServiceProvider extends IlluminateServiceProvider
{

    /**
     * @return void
     * @throws Exception
     */
    public function boot(): void
    {

        /**
         * Replace the sanctum personal access token model with the linky version if linky auth is enabled.
         */
        if (config('linky.auth.use_linky_auth')) {
            Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'linky');
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'linky');

        $this->registerPublishing();
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

        /**
         * Publishing resources
         */
        $this->publishes([
            __DIR__ . '/../config/linky.php' => config_path('linky.php'),
        ], 'illegal-linky-config');

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

        /**
         * Boot authentication
         */
        InsideAuth::boot(config('linky.auth.inside_auth_name'))
            ->withDashboard('linky.admin.link.index');
    }

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
         * Singletons
         */
        $this->app->singleton(CollectionRepository::class, function (Application $app) {
            return new CollectionRepository($app->make(SlugGenerator::class));
        });
        $this->app->singleton(ContentRepository::class, function () {
            return new ContentRepository();
        });
        $this->app->singleton(HitRepository::class, function () {
            return new HitRepository();
        });
        $this->app->singleton(LinkRepository::class, function (Application $app) {
            return new LinkRepository($app->make(SlugGenerator::class));
        });
        $this->app->singleton(PageRepository::class, function (Application $app) {
            return new PageRepository($app->make(SlugGenerator::class));
        });
        $this->app->singleton(SlugGenerator::class, function () {
            return new SlugGenerator(config('linky.slug_min_length'));
        });
        $this->app->singleton(Authentication::class, function () {
            return new Authentication(config('linky.auth.inside_auth_name'));
        });


        if (config('linky.auth.use_linky_auth')) {
            Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'linky');
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'linky');

        $this->registerPublishing();
        $this->loadMigrationsFrom([
            __DIR__ . '/../database/migrations/'
        ]);


        $this->publishes([
            __DIR__ . '/../config/linky.php' => config_path('linky.php'),
        ], 'illegal-linky-config');

    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    private function registerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../public/build' => public_path('vendor/linky'),
            ], ['linky-assets', 'laravel-assets']);
        }
    }
}
