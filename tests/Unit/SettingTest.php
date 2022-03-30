<?php

namespace Nci\SettingsPackage\Tests\Unit;

use Nci\SettingsPackage\Models\Setting;
use Nci\SettingsPackage\Business\SettingBusiness;
use Nci\SettingsPackage\Tests\TestCase;

class SettingTest extends TestCase
{

    private int $userCount;
    private int $appCount;

    public function setUp(): void
    {
        parent::setUp();

        $this->userCount = 10;
        $this->appCount  = 20;
        Setting::factory()->count($this->userCount)->create();
        Setting::factory()->count($this->appCount)->create();
    }

    // /** @test */
    // function settings_can_be_listed_and_filtered()
    // {
        // $settings     = SettingBusiness::get();
        // $appSettings  = SettingBusiness::get(['overridable' => false]);
        // $userSettings = SettingBusiness::get(['overridable' => true]);
        // $this->assertCount($this->userCount + $this->appCount, $settings);
        // $this->assertCount($this->appCount, $appSettings);
        // $this->assertCount($this->userCount, $userSettings);
    // }

    /** @test */
    function a_setting_can_be_updated()
    {
        $settingExpected = Setting::first();
        $value           = 'test';

        SettingBusiness::update($settingExpected->id, ['default_value' => $value]);

        $setting = SettingBusiness::find($settingExpected->id);

        $this->assertEquals($value, $setting->default_value);
        $this->assertNotEquals($setting->default_value, $settingExpected->default_value);
    }
}
