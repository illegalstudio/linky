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
     * Register the application services.
     */
    public function register(): void
    {
        /**
         * Linky config file
         */
        $this->mergeConfigFrom(__DIR__ . "/../config/linky.php", "linky");
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'linky');
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'linky');
        $this->loadMigrationsFrom([__DIR__ . '/../database/migrations/']);

        $this->singletons();
        $this->publishing();
    }

    /**
     * Bootstrap the application services.
     * @throws Exception
     */
    public function boot(): void
    {
        $this->blade();
        $this->livewire();
        $this->auth();
    }

    /**
     * Register service singletons
     */
    private function singletons(): void
    {
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
    }


    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    private function publishing(): void
    {
        if ($this->app->runningInConsole()) {
            /**
             * Configurations
             */
            $this->publishes([
                __DIR__ . '/../config/linky.php' => config_path('linky.php'),
            ], 'illegal-linky-config');

            /**
             * Assets
             */
            $this->publishes([
                __DIR__ . '/../public/build' => public_path('vendor/illegal/linky'),
            ], ['linky-assets', 'laravel-assets']);
        }
    }

    /**
     * Register blade components
     */
    private function blade(): void
    {
        Blade::componentNamespace('Illegal\\Linky\\View\\Components', 'linky');
    }

    /**
     * Register livewire components
     */
    private function livewire(): void
    {
        Livewire::component('linky::link-list', LinkList::class);
        Livewire::component('linky::collection-list', CollectionList::class);
        Livewire::component('linky::collection-content-manager', CollectionContentManager::class);
        Livewire::component('linky::page-list', PageList::class);
    }

    /**
     * Register the authentication services.
     *
     * @throws Exception
     */
    private function auth(): void
    {
        /**
         * Boot authentication
         */
        InsideAuth::boot(config('linky.auth.name'))
            ->enabled(config('linky.auth.enabled'))
            ->withoutEmailVerification(config('linky.auth.disable.email_verification'))
            ->withoutRegistration(config('linky.auth.disable.registration'))
            ->withoutForgotPassword(config('linky.auth.disable.forgot_password'))
            ->withoutUserProfile(config('linky.auth.disable.user_profile'))
            ->withConfirmPasswordTemplate('linky::auth.confirm-password')
            ->withForgotPasswordTemplate('linky::auth.forgot-password')
            ->withLoginTemplate('linky::auth.login')
            ->withRegisterTemplate('linky::auth.register')
            ->withProfileEditTemplate('linky::auth.profile.edit')
            ->withResetPasswordTemplate('linky::auth.reset-password')
            ->withVerifyEmailTemplate('linky::auth.verify-email')
            ->withDashboard('linky.admin.link.index')
            ->withHomepage('linky.admin.link.index');

        $this->app->singleton(Authentication::class, function () {
            return new Authentication(config('linky.auth.name'), config('linky.auth.enabled'));
        });

        /**
         * Replace the sanctum personal access token model with the linky version if linky auth is enabled.
         */
        if (config('linky.auth.enabled')) {
            Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
        }
    }
}
