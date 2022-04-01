<?php

namespace Nci\SettingsPackage\Business;

use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Nci\SettingsPackage\Business\Interfaces\SettingOptionHandler\SettingOptionHandlerList;
use Nci\SettingsPackage\Enums\ErrorText;
use Nci\SettingsPackage\Enums\SettingType;
use Nci\SettingsPackage\Models\Setting;

class SettingBusiness
{
    public static function get(array $data = null): Collection
    {
        $settings = DB::table('settings')
                        ->when(isset($data['overridable']), function ($query) use($data) {
                            $query->where('overridable', $data['overridable']);
                        })
                        ->when(isset($data['code']), function ($query) use($data) {
                            $query->where('code', 'LIKE', '%' . $data['code'] . '%');
                        })
                        ->when(isset($data['favorite']), function ($query) use($data) {
                            $query->where('favorite', $data['favorite']);
                        });

        return $settings->get();
    }

    public static function find(int $settingId): Setting
    {
        return Setting::find($settingId);
    }

    public static function findByCode(string $code): Setting
    {
        return Setting::where('code', $code)->first();
    }

    public static function getId(string $code): int
    {
        return static::getFieldValue($code, 'id');
    }

    public static function getValue(string $code): string
    {
        $value = static::getFieldValue($code, 'default_value');
        return empty($value) ? '' : $value;
    }

    public static function getOptionsClass(): array
    {
        return SettingOptionHandlerList::get();
    }

    public static function getTypes(): array
    {
        return SettingType::cases();
    }

    public static function update(int $settingId, array $data): Setting
    {
        $setting = Setting::find($settingId);

        if (isset($data['options_class'])) {
            if (!in_array($data['options_class'], SettingOptionHandlerList::get())) {
                throw new Exception(ErrorText::API_E_SETTING05, 404);
            }
            $setting->options_class = $data['options_class'];
        }

        if (isset($data['options_data'])) {
            $setting->options_data = $data['options_data'];
        }

        if (isset($data['default_value'])) {
            try {
                $setting->checkOptions($data['default_value']);
                $setting->default_value = $data['default_value'];
            } catch (Exception $e) {
                throw new Exception($e->getMessage(), 404);
            }
        }

        if (isset($data['favorite'])) {
            $setting->favorite = $data['favorite'];
        }

        $setting->save();

        return $setting;
    }

    private static function getFieldValue(string $code, string $field): mixed
    {
        return Setting::where('code', $code)->pluck($field)->first();
    }
}