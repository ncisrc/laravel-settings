<?php

namespace Nci\Settings\Tests;

use Nci\Settings\SettingsPackageServiceProvider;
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
        include_once __DIR__.'/../database/migrations/2022_03_24_155550_create_settings_table.php';
        include_once __DIR__.'/../database/migrations/2022_03_25_160000_create_user_setting_table.php';

        (new \CreateSettingsTable)->up();
        (new \CreateUserSettingTable)->up();
    }
}