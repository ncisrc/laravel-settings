<?php

namespace Nci\Settings\Tests\Unit;

use Exception;
use Nci\Settings\Business\UserSettingBusiness;
use Nci\Settings\Enums\ErrorText;
use Nci\Settings\Models\Setting;
use Nci\Settings\Tests\TestCase;

class UserSettingTest extends TestCase
{
    private Setting $defSetting;
    private Setting $johnRawSetting;
    private Setting $janeRawSetting;
    private Setting $johnSetting;

    public function setUp(): void
    {
        parent::setUp();

        $this->defSetting     = Setting::factory()->withOverridable(false)->create();
        $this->johnRawSetting = Setting::factory()->create();
        $this->janeRawSetting = Setting::factory()->create();

        UserSettingBusiness::setValue(1, $this->johnRawSetting->id, 'john');
        $this->johnSetting = UserSettingBusiness::find(1, $this->johnRawSetting->id);

        UserSettingBusiness::setValue(2, $this->janeRawSetting->id, 'jane');
        $this->janeSetting = UserSettingBusiness::find(2, $this->janeRawSetting->id);
    }

    /** @test */
    public function user_can_get_a_settings_list()
    {
        $settings = UserSettingBusiness::get(1);
        $this->assertCount(3, $settings);
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
    public function user_can_not_update_non_overridable_setting()
    {
        try {
            UserSettingBusiness::setValue(1, $this->defSetting->id, 'test');
        } catch (Exception $e) {
            $this->assertEquals(ErrorText::API_E_SETTING04, $e->getMessage());
        }
    }

    /** @test */
    public function user_can_get_setting_value()
    {
        $value = UserSettingBusiness::getValue(1, $this->johnSetting->code);
        $this->assertEquals('john', $value);
        $this->assertEmpty(UserSettingBusiness::getValue(1, $this->defSetting->code));
    }
}