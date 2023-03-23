<?php

namespace Illegal\Linky;

use App;
use Illegal\Linky\Repositories\CollectionRepository;
use Illegal\Linky\Repositories\ContentRepository;
use Illegal\Linky\Repositories\HitRepository;
use Illegal\Linky\Repositories\LinkRepository;
use Illegal\Linky\Repositories\PageRepository;
use Illegal\Linky\Services\SlugGenerator;
use Illegal\Linky\Auth\Passwords\PasswordBrokerManager;
use Illegal\Linky\Models\Auth\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
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
         * Load authentication config file.
         * If the system is using linky authentication, we will use the linky auth config file, backing up the original.
         * Otherwise, we will restore the original config file.
         *
         * We will also try to remove the Event listener for the email verification notification, if the linky auth is enabled.
         * Otherwise, we will add it back.
         *
         * @todo Move this to a command, to avoid doing this on every request.
         */

        /*
        if(config('linky.auth.use_linky_auth')) {
            if(File::exists(base_path() . "/config/auth.php")) {
                File::move(base_path() . "/config/auth.php", base_path() . "/config/auth.php.linky");
            }
            $this->mergeConfigFrom(__DIR__ . "/../config/auth.php", "auth");

            if (File::exists(base_path() . "/app/Providers/EventServiceProvider.php")) {
                $eventServiceProvider = File::get(base_path() . "/app/Providers/EventServiceProvider.php");
                $eventServiceProvider = str_replace(
                    "use Illuminate\Auth\Listeners\SendEmailVerificationNotification;",
                    "use Illegal\Linky\Listeners\DummySendEmailVerificationNotification as SendEmailVerificationNotification;",
                    $eventServiceProvider
                );
                File::put(base_path() . "/app/Providers/EventServiceProvider.php", $eventServiceProvider);
            }
        } else {
            if (File::exists(base_path() . "/config/auth.php.linky")) {
                File::move(base_path() . "/config/auth.php.linky", base_path() . "/config/auth.php");
            }

            if (File::exists(base_path() . "/app/Providers/EventServiceProvider.php")) {
                $eventServiceProvider = File::get(base_path() . "/app/Providers/EventServiceProvider.php");
                $eventServiceProvider = str_replace(
                    "use Illegal\Linky\Listeners\DummySendEmailVerificationNotification as SendEmailVerificationNotification;",
                    "use Illuminate\Auth\Listeners\SendEmailVerificationNotification;",
                    $eventServiceProvider
                );
                File::put(base_path() . "/app/Providers/EventServiceProvider.php", $eventServiceProvider);
            }
        }
        */

        /**
         * Singletons
         */
        $this->app->singleton(CollectionRepository::class, function () {
            return new CollectionRepository(App::make(SlugGenerator::class));
        });
        $this->app->singleton(ContentRepository::class, function () {
            return new ContentRepository();
        });
        $this->app->singleton(HitRepository::class, function () {
            return new HitRepository();
        });
        $this->app->singleton(LinkRepository::class, function () {
            return new LinkRepository(App::make(SlugGenerator::class));
        });
        $this->app->singleton(PageRepository::class, function () {
            return new PageRepository(App::make(SlugGenerator::class));
        });
        $this->app->singleton(SlugGenerator::class, function () {
            return new SlugGenerator(config('linky.slug_min_length'));
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

        Config::set('auth.guards.linky_web', [
            'driver'   => 'session',
            'provider' => 'linky_web',
        ]);

        // Will use the EloquentUserProvider driver with the Admin model
        Config::set('auth.providers.linky_web', [
            'driver' => 'eloquent',
            'model'  => User::class
        ]);

        Config::set('auth.passwords.linky_users', [
            'provider' => 'linky_web',
            'table'    => config('linky.db.prefix') . 'password_resets',
            'expire'   => 60,
            'throttle' => 60,
        ]);

        $this->app->singleton(PasswordBrokerManager::class, function (Application $app) {
            return new PasswordBrokerManager($app);
        });
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    private function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../public/build' => public_path('vendor/linky'),
            ], ['linky-assets', 'laravel-assets']);
        }
    }
}
