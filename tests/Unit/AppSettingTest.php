<?php

namespace Nci\SettingsPackage\Tests\Unit;

use Nci\SettingsPackage\Business\AppSettingBusiness;
use Nci\SettingsPackage\Classes\App;
use Nci\SettingsPackage\Models\Setting;
use Nci\SettingsPackage\Tests\TestCase;

class AppSettingTest extends TestCase
{
    /** @test */
    function app_should_only_see_app_settings()
    {
        Setting::factory()->userScope()->create();
        $appSettingExpected = Setting::factory()->appScope()->create();
        $appSettings        = AppSettingBusiness::appSettingSearch();

        $this->assertEquals(1, count($appSettings));
        $this->assertEquals($appSettingExpected->id, $appSettings[0]->id);
        $this->assertEquals(class_basename(App::class), $appSettings[0]->scope);

        $appSetting = AppSettingBusiness::appSettingFind($appSettingExpected->id);

        $this->assertEquals($appSettingExpected->id, $appSetting->id);
        $this->assertEquals(class_basename(App::class), $appSetting->scope);
    }

    /** @test */
    function app_can_update_setting_default_value()
    {
        $appSettingExpected = Setting::factory()->appScope()->create();
        $value              = 'test';

        App::setSetting($appSettingExpected->id, $value);

        $appSetting = App::setting($appSettingExpected->id);

        $this->assertEquals($value, $appSetting->default_value);
        $this->assertNotEquals($appSetting->default_value, $appSettingExpected->default_value);
    }
}