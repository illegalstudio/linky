<?php

namespace Illegal\Linky\Tests;

use Illegal\Linky\AuthServiceProvider;
use Illegal\Linky\EventServiceProvider;
use Illegal\Linky\RouteServiceProvider;
use Illegal\Linky\ServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

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

    protected function resolveApplicationCore($app)
    {
        parent::resolveApplicationCore($app);

        $app->detectEnvironment(function () {
            return 'self-testing';
        });
    }


}
