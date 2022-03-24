<?php

namespace Nci\SettingsPackage;

use Nci\SettingsPackage\SettingsPackageServiceProvier;
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
            SettingsPackageServiceProvier::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // TODO
    }
}