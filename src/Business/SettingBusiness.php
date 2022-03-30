<?php

namespace Nci\SettingsPackage\Business;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Nci\SettingsPackage\Models\Setting;

class SettingBusiness
{
    public static function get(array $data = null): Collection
    {
        $settings = DB::table('settings');

        if (isset($data['group'])) {
            $settings->where('groupe', 'LIKE', '%' . $data['group'] . '%');
        }

        if (isset($data['scope'])) {
            $settings->where('scope', $data['scope']);
        }

        if (isset($data['code'])) {
            $settings->where('code', 'LIKE', '%' . $data['code'] . '%');
        }

        if (isset($data['favorite'])) {
            $settings->where('favorite', $data['favorite']);
        }

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

    public static function update(int $settingId, array $data): Setting
    {
        $setting = Setting::find($settingId);

        if (isset($data['json_options'])) {
            $setting->json_options = $data['json_options'];
        }

        if (isset($data['default_value'])) {
            $setting->default_value = $data['default_value'];
        }

        if (isset($data['favorite'])) {
            $setting->favorite = $data['favorite'];
        }

        $setting->save();

        return $setting;
    }
}