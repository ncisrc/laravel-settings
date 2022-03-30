<?php

namespace Nci\SettingsPackage\Business;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Nci\SettingsPackage\Enums\SettingType;
use Nci\SettingsPackage\Models\Setting;
use Nci\SettingsPackage\Models\UserSetting;
use Nci\SettingsPackage\Enums\ErrorText;

class UserSettingBusiness
{
    public static function get($userId): Collection
    {
        return static::getQuery($userId)->get();
    }

    public static function find(int $userId, int $settingId): Setting
    {
        return static::getQuery($userId)->where('settings.id', $settingId)->first();
    }

    public static function findByCode(int $userId, string $code): Setting
    {
        return static::getQuery($userId)->where('settings.code', $code)->first();
    }

    public static function getValue(int $userId, string $code): string
    {
        $setting = static::findByCode($userId, $code);
        return (is_null($setting->value)) ? $setting->default_value : $setting->value;
    }

    public static function setValue(array $data): bool
    {
        $setting = static::find($data['user_id'], $data['setting_id']);

        if (!$setting->overridable) {
            throw new Exception(ErrorText::API_E_SETTING04, 404);
        }

        $userSetting = static::findOrCreateUserSetting($data['user_id'], $data['setting_id']);

        try {
            $setting->checkOptions($data['value']);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 404);
        }

        $userSetting->value = $data['value'];
        $userSetting->save();

        return true;
    }

    private static function getQuery(int $userId)
    {
        return Setting::leftJoin('user_setting', function($join) use($userId){
            $join->on('user_setting.setting_id', 'settings.id')->where('user_setting.user_id', $userId);
        });
    }

    private static function findOrCreateUserSetting(int $userId, int $settingId): UserSetting
    {
        $userSetting = UserSetting::where('user_id', $userId)->where('setting_id', $settingId)->first();

        if (is_null($userSetting)) {
            $userSetting = new UserSetting();
            $userSetting->user_id    = $userId;
            $userSetting->setting_id = $settingId;
        }

        return $userSetting;
    }
}