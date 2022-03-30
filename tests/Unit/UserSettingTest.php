<?php

namespace Nci\SettingsPackage\Tests\Unit;

use Nci\SettingsPackage\Business\Interfaces\SettingOptionHandler\SettingOptionHandlerList;
use Nci\SettingsPackage\Business\UserSettingBusiness;
use Nci\SettingsPackage\Models\Setting;
use Nci\SettingsPackage\Tests\TestCase;

class UserSettingTest extends TestCase
{
    private Setting $appSetting;
    private Setting $defSetting;
    private Setting $johnRawSetting;
    private Setting $janeRawSetting;
    private Setting $johnSetting;

    public function setUp(): void
    {
        parent::setUp();

        $this->appSetting     = Setting::factory()->create();
        $this->defSetting     = Setting::factory()->create();
        $this->johnRawSetting = Setting::factory()->create();
        $this->janeRawSetting = Setting::factory()->create();

        UserSettingBusiness::setValue([
            'setting_id' => $this->johnRawSetting->id,
            'user_id'    => 1,
            'value'      => 'john'
        ]);
        $this->johnSetting = UserSettingBusiness::find(1, $this->johnRawSetting->id);

        UserSettingBusiness::setValue([
            'setting_id' => $this->janeRawSetting->id,
            'user_id'    => 2,
            'value'      => 'jane'
        ]);
        $this->janeSetitng = UserSettingBusiness::find(2, $this->janeRawSetting->id);
    }

    /** @test */
    public function user_can_have_custom_setting_value()
    {
        $this->assertEquals($this->johnRawSetting->id, $this->johnSetting->id);
        $this->assertEquals('john', $this->johnSetting->value);
        $this->assertNotEquals($this->johnRawSetting->default_value, $this->johnSetting->value);

        $janeVersion = UserSettingBusiness::find(2, $this->johnRawSetting->id);
        $this->assertEquals($this->johnSetting->id, $janeVersion->id);
        $this->assertEquals($this->johnRawSetting->default_value, $janeVersion->value);
        $this->assertNotEquals($this->johnSetting->value, $janeVersion->value);
    }

    /** @test */
    public function user_should_only_see_his_own_settings_or_default()
    {
        $johnSettings = UserSettingBusiness::get(1);
        $this->assertCount(4, $johnSettings);
        $janeSettings = UserSettingBusiness::get(2);
        $this->assertCount(4, $janeSettings);

        $appMissing = true;
        foreach ($johnSettings as $johnSetting) {
            $found = false;
            if ($johnSetting->id === $this->appSetting->id) {
                $appMissing = false;
            }
            foreach ($janeSettings as $janeSetting) {
                if ($johnSetting->id === $janeSetting->id) {
                    $found = true;

                    if ($johnSetting->id === $this->defSetting->id) {
                        $this->assertEquals($this->defSetting->default_value, $johnSetting->value);
                        $this->assertEquals($this->defSetting->default_value, $janeSetting->value);
                    }

                    if ($johnSetting->id === $this->johnRawSetting->id) {
                        $this->assertNotEquals($this->johnRawSetting->default_value, $johnSetting->value);
                        $this->assertEquals($this->johnRawSetting->default_value, $janeSetting->value);
                    }

                    if ($johnSetting->id === $this->janeRawSetting->id) {
                        $this->assertEquals($this->janeRawSetting->default_value, $johnSetting->value);
                        $this->assertNotEquals($this->janeRawSetting->default_value, $janeSetting->value);
                    }
                }
            }
            $this->assertTrue($found);
        }
    }
}