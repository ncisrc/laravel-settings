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

    public static function setValue(array $data): bool
    {
        $userSetting = UserSetting::where('user_id', $data['user_id'])->where('setting_id', $data['setting_id'])->first();

        if (is_null($userSetting)) {
            $userSetting = new UserSetting();
            $userSetting->user_id    = $data['user_id'];
            $userSetting->setting_id = $data['setting_id'];
        }

        try {
            static::checkOptions($data['setting_id'], $data['value']);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 404);
        }

        $userSetting->value = $data['value'];
        $userSetting->save();

        return true;
    }

    private static function checkOptions(int $settingId, string $value): void
    {
        $setting = Setting::find($settingId);
        if (!is_null($setting->options())) {
            if (in_array($setting->options()->type, ['array', 'jsonArray'])) {
                $needle = (in_array($setting->type, [SettingType::Boolean, SettingType::Number, SettingType::String])) ?
                    $value : json_decode($value);
                if (!in_array($needle, json_decode($setting->options()->data))) {
                    throw new Exception(ErrorText::API_E_SETTING01, 404);
                }
            }
        }
    }

    private static function getQuery(int $userId)
    {
        return Setting::leftJoin('user_setting', function($join) use($userId){
            $join->on('user_setting.setting_id', 'settings.id')->where('user_setting.user_id', $userId);
        })->where('scope', 'User');
    }
}