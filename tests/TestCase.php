<?php

namespace Illegal\Linky\Tests;

use Illegal\Linky\AuthServiceProvider;
use Illegal\Linky\EventServiceProvider;
use Illegal\Linky\RouteServiceProvider;
use Illegal\Linky\ServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Termwind\Components\Li;

/**
 * Class TestCase
 *
 * @package Illegal\Linky\Tests
 */
class TestCase extends \Orchestra\Testbench\TestCase
{
    use InteractsWithViews, RefreshDatabase;

    /**
     * Automatically enables package discoveries.
     *
     * @var bool
     */
    protected $enablesPackageDiscoveries = true;

    protected function setUp(): void
    {
        parent::setUp();

        Livewire::component('linky::collection-list', \Illegal\Linky\Http\Livewire\CollectionList::class);
        Livewire::component('linky::collection-content-manager', \Illegal\Linky\Http\Livewire\CollectionContentManager::class);
        Livewire::component('linky::link-list', \Illegal\Linky\Http\Livewire\LinkList::class);
        Livewire::component('linky::page-list', \Illegal\Linky\Http\Livewire\PageList::class);

    }


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
                EventServiceProvider::class,
                AuthServiceProvider::class,
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

    /**
     * Resolve application core configuration implementation.
     *
     * @param Application $app
     *
     * @return void
     */
    protected function resolveApplicationConfiguration($app): void
    {
        parent::resolveApplicationConfiguration($app);

        /**
         * using linky auth
         */
        $app['config']['linky'] = require __DIR__ . '/../config/linky.php';

        /**
         * loading Linky auth config
         */
        $app['config']['auth'] = require __DIR__ . '/../config/auth.php';
    }

    protected function resolveApplicationCore($app)
    {
        parent::resolveApplicationCore($app);

        $app->detectEnvironment(function () {
            return 'self-testing';
        });
    }

}
