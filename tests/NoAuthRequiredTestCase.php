<?php

namespace Illegal\Linky\Tests;

use Illegal\Linky\RouteServiceProvider;
use Illegal\Linky\ServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\LivewireServiceProvider;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Class TestCase
 *
 * @package Illegal\Linky\Tests
 */
class NoAuthRequiredTestCase extends \Orchestra\Testbench\TestCase
{
    use InteractsWithViews, RefreshDatabase;

    /**
     * Automatically enables package discoveries.
     *
     * @var bool
     */
    protected $enablesPackageDiscoveries = true;

    /**
     * @param $app
     * @return string[]
     */
    protected function getPackageProviders($app)
    {
        return array_merge(
            parent::getPackageProviders($app),
            [
                ServiceProvider::class,
                RouteServiceProvider::class,
                LivewireServiceProvider::class
            ]
        );
    }

    public function ignorePackageDiscoveriesFrom()
    {
        return [];
    }

    /**
     * @param Application $app
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function getEnvironmentSetUp($app)
    {
        $config = $app->get('config');

        $config->set('logging.default', 'errorlog');

        $config->set('database.default', 'testbench');

        $config->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function resolveApplicationCore($app)
    {
        parent::resolveApplicationCore($app);

        $app->detectEnvironment(function () {
            return 'self-testing';
        });
    }


    /**
     * Resolve application core configuration implementation.
     *
     * @param Application $app
     *
     * @return void
     * @noinspection LaravelFunctionsInspection
     */
    protected function resolveApplicationConfiguration($app): void
    {
        parent::resolveApplicationConfiguration($app);

        /**
         * using linky auth
         */
        $app['config']['linky'] = [
            'home_slug' => env('LINKY_HOME_SLUG', '@'),
            'auth'      => [
                'use_linky_auth'     => env('LINKY_AUTH_USE_LINKY_AUTH', true),
                'require_valid_user' => env('LINKY_AUTH_REQUIRE_VALID_USER', false),
                'multi_tenant'       => env('LINKY_AUTH_MULTI_TENANT', false),
            ],
            'db'        => [
                'prefix' => env('LINKY_DB_PREFIX', 'linky_'),
            ]
        ];

        /**
         * loading Linky auth config
         */
        $app['config']['auth'] = require __DIR__ . '/config/auth.php';
    }

}
