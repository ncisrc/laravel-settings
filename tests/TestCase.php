<?php

namespace Nci\SettingsPackage\Tests;

use Nci\SettingsPackage\SettingsPackageServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

class TestCase extends TestbenchTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // TODO
    }

    protected function getPackageProviders($app)
    {
        return [
            SettingsPackageServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // TODO
    }
}