<?php

namespace Nci\Settings\Tests\Unit;

use Exception;
use Nci\Settings\Models\Setting;
use Nci\Settings\Business\SettingBusiness;
use Nci\Settings\Enums\ErrorText;
use Nci\Settings\Tests\TestCase;

class SettingTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

    }

    /** @test */
    public function setting_should_have_options()
    {
        $setting = Setting::factory()->create();
        $this->assertIsArray($setting->options);
    }

    /** @test */
    public function setting_with_strings_array_options_should_have_it_in_options()
    {
        $setting = $this->assertOptions('Nci\Settings\Business\Interfaces\SettingOptionHandler\ArrayOptionHandler',
            '["test1","test2","test3"]');

        $this->assertEquals('test1', $setting->options[0]);
        $this->assertEquals('test2', $setting->options[1]);
        $this->assertEquals('test3', $setting->options[2]);
    }

    /** @test */
    public function setting_with_json_array_options_should_have_it_in_options()
    {
        $setting = $this->assertOptions('Nci\Settings\Business\Interfaces\SettingOptionHandler\JsonArrayOptionHandler',
        '[
            {"code": ["ItemID1"], "value": ["ItemValue1"]},
            {"code": ["ItemID2"], "value": ["ItemValue2"]},
            {"code": ["ItemID3"], "value": ["ItemValue3"]}
          ]');

        for ($i=0; $i < count($setting->options) -1; $i++) {
            $this->assertEquals("ItemID" . $i + 1, $setting->options[$i]->code[0]);
            $this->assertEquals("ItemValue" . $i + 1, $setting->options[$i]->value[0]);
        }
    }

    /** @test */
    public function setting_with_jsonsql_should_execute_sql_request()
    {
        $select = 'item1 as code, item2 as value';
        try {
            Setting::factory()
                    ->withOptionsClass('Nci\Settings\Business\Interfaces\SettingOptionHandler\SqlOptionHandler')
                    ->withOptionsData('{"select":"'.$select.'","from":"test","where":"item3 > 10"}')
                    ->create();
        } catch (Exception $e) {
            $this->assertTrue(str_contains($e->getMessage(), 'no such table: test'));
            $this->assertTrue(str_contains($e->getMessage(), 'SELECT '.$select.' FROM test WHERE item3 > 10'));
        }
    }

    /** @test */
    public function settings_can_be_listed_and_filtered()
    {
        Setting::factory()->count(30)->create();
        Setting::factory()->withCode('user.background.color')->create();
        Setting::factory()->withCode('user.background.wallpaper')->create();

        $settings = SettingBusiness::get();
        $this->assertCount(32, $settings);

        $settings = SettingBusiness::get(['code' => 'background']);
        $this->assertCount(2, $settings);

        $settings = SettingBusiness::get(['code' => 'user.background.color']);
        $this->assertCount(1, $settings);
    }

    /** @test  */
    public function  options_class_can_be_updated()
    {
        $settingExpected = Setting::factory()->create();
        $falseClass      = 'Nci\Settings\Business\Interfaces\SettingOptionHandler\DummyOptionHandler';
        $trueClass       = 'Nci\Settings\Business\Interfaces\SettingOptionHandler\ArrayOptionHandler';

        try {
            SettingBusiness::update($settingExpected, ['options_class' => $falseClass]);
        } catch (Exception $e) {
            $this->assertEquals(ErrorText::API_E_SETTING05, $e->getMessage());
        }

        $this->assertNotEquals($trueClass, $settingExpected->options_class);
        SettingBusiness::update($settingExpected, ['options_class' => $trueClass]);
        $settingExpected->refresh();
        $this->assertEquals($trueClass, $settingExpected->options_class);
    }

    /** @test */
    public function default_value_can_be_updated()
    {
        $settingExpected = Setting::factory()->create();
        $value           = 'test';

        $this->assertNotEquals($settingExpected->default_value, $value);
        SettingBusiness::update($settingExpected, ['default_value' => $value]);
        $settingExpected->refresh();
        $this->assertEquals($value, $settingExpected->default_value);
    }

    /** @test */
    public function options_class_available_can_be_listed()
    {
        $classes = SettingBusiness::getOptionsClass();
        $this->assertIsArray($classes);
        $this->assertNotEmpty($classes);
    }

    /** @test */
    public function types_available_can_be_listed()
    {
        $types = SettingBusiness::getTypes();
        $this->assertIsArray($types);
        $this->assertNotEmpty($types);
    }

    /** @test */
    public function setting_value_can_get_alone()
    {
        $code     = 'user.background.wallpaper';
        $expected = 'nci.png';
        Setting::factory()->withCode($code)->withDefaultValue($expected)->create();

        $value = SettingBusiness::getValue($code);
        $this->assertEquals($expected, $value);
    }

    private function assertOptions(string $class, string $data): Setting
    {
        $setting = Setting::factory()
                            ->withOptionsClass($class)
                            ->withOptionsData($data)
                            ->create();

        $setting = SettingBusiness::find($setting->id);

        $this->assertIsArray($setting->options);
        $this->assertNotEmpty($setting->options);

        return $setting;
    }
}
