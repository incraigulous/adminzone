<?php
namespace  Incraigulous\AdminZone\Tests;

use Faker\Factory;
use Faker\Generator;
use Incraigulous\AdminZone\AdminZoneServiceProvider;
use Orchestra\Testbench\TestCase as Base;
use Helmich\JsonAssert\JsonAssertions;
use Spatie\BladeX\BladeXServiceProvider;

/**
 * Class TestCase
 */
class TestCase extends Base
{
    use JsonAssertions;
    protected $callback;

    /**
     * @var $faker Generator;
     */
    protected $faker;

    protected function getPackageAliases($app)
    {
        return [
            'config' => 'Illuminate\Config\Repository'
        ];
    }

    protected function getPackageProviders($app)
    {
        return [
            AdminZoneServiceProvider::class,
            BladeXServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function setUp()
    {
        parent::setUp();
        foreach (glob(__DIR__.'/factories/*.php') as $filename)
        {
            require_once $filename;
        }
        $this->loadLaravelMigrations(['--database' =>  'testing']);
        $this->artisan('migrate', ['--database' => 'testing'])->run();

        $this->faker = \Faker\Factory::create();
        $this->callback = function($param = false) {
            $this->assertTrue($param);
            return $param;
        };
    }
}
