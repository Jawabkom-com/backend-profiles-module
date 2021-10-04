<?php

namespace Jawabkom\Backend\Module\Profile\Test;

use Jawabkom\Backend\Module\Profile\Test\Classes\Provider\ProfileServiceProvider;
use Jawabkom\Backend\Module\Profile\Test\Classes\Provider\TranslationServiceProvider;
use Orchestra\Testbench\TestCase as TestCaseAlisa;

class AbstractTestCase extends TestCaseAlisa
{

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return string[]
     */
    protected function getPackageProviders($app): array
    {
        return [
            ProfileServiceProvider::class,
        ];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testDB');
        $app['config']->set('database.connections.testDB', [
            'driver' => 'sqlite',
            'database' => ':memory:'
        ]);
        $classes =[
       //     "CreateTranslationTable",
        ];
        foreach($classes as $class){
          $class ="\\Jawabkom\\Backend\\Module\\Translation\\Test\\Classes\\Database\\Migrations\\{$class}";
            (new $class)->up();
        }

    }

}
