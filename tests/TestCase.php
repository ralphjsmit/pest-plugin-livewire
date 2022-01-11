<?php

namespace RalphJSmit\PestPluginLivewire\Tests;

use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-filament-cms_table.php.stub';
        $migration->up();
        */
    }
}
