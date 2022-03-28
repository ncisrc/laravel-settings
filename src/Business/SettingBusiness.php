<?php

namespace Nci\SettingsPackage\Business;

use Exception;
use Nci\SettingsPackage\Classes\App;
use Nci\SettingsPackage\Models\Setting;

class SettingBusiness
{
    public static function settingSearch(array $data): array
    {
        return App::settings($data);
    }

    public static function settingFind(int $settingId): Setting
    {
        return Setting::find($settingId);
    }

    public static function settingUpdate(Setting $setting, array $data): Setting
    {
        if (isset($data['json_options'])) {
            $setting->json_options = $data['json_options'];
        }

        if (isset($data['default'])) {
            $setting->default = $data['default'];
        }

        if (isset($data['favorite'])) {
            $setting->favorite = $data['favorite'];
        }

        $setting->save();

        return $setting;
    }
}