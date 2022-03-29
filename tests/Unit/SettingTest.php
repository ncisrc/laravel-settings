<?php

namespace Nci\SettingsPackage\Tests\Unit;

use Nci\SettingsPackage\Business\SettingBusiness;
use Nci\SettingsPackage\Models\Setting;
use Nci\SettingsPackage\Tests\TestCase;
use stdClass;

class SettingTest extends TestCase
{

    private Setting  $setting;
    private stdClass $json;
    private int      $count;

    public function setUp(): void
    {
        parent::setUp();

        $this->count = 50;
        Setting::factory()->count($this->count)->create();
        $this->setting = Setting::first();
        $this->json = new stdClass();
        $this->json->type = "array";
        $this->json->data = [
            "test1",
            "test2",
        ];
    }

    /** @test */
    public function a_setting_can_return_json_options_as_json()
    {
        $this->assertEmpty($this->setting->json_options);
        $this->assertNull($this->setting->options());

        $this->setting->json_options = json_encode($this->json);
        $this->assertEquals($this->json, $this->setting->options());
    }

    /** @test */
    public function a_setting_can_be_found_by_its_id()
    {
        $this->assertEquals($this->setting->id, SettingBusiness::settingFind($this->setting->id)->id);
    }

    /** @test */
    public function a_setting_can_be_updated()
    {
        $data = [
            'json_options'  => json_encode($this->json),
            'default_value' => 'test1',
            'favorite'      => true
        ];

        SettingBusiness::settingUpdate($this->setting, $data);

        $this->assertEquals($data['json_options'],  $this->setting->json_options);
        $this->assertEquals($data['default_value'], $this->setting->default_value);
        $this->assertEquals($data['favorite'],      $this->setting->favorite);
    }

    /** @test */
    public function settings_can_be_listed()
    {
        $settings = SettingBusiness::settingSearch();
        $this->assertCount($this->count, $settings);
    }
}