<?php

namespace Nci\Settings\Business;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Nci\Settings\Models\Setting;
use Nci\Settings\Models\UserSetting;
use Nci\Settings\Enums\ErrorText;

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
        $value = UserSetting::where([
            'user_id'=> $userId,
            'setting_id' => SettingBusiness::getId($code)
            ])->pluck('value')->first();
        if (empty($value)) $value = SettingBusiness::getValue($code);

        return empty($value) ? '' : $value;
    }

    public static function setValue(int $userId, int $settingId, string $value): bool
    {
        $setting = static::find($userId, $settingId);

        if (!$setting->overridable) {
            throw new Exception(ErrorText::API_E_SETTING04, 404);
        }

        $userSetting = static::findOrCreate($userId, $settingId);

        try {
            $setting->checkOptions($value);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 404);
        }

        $userSetting->value = $value;
        $userSetting->save();

        return true;
    }

    private static function getQuery(int $userId)
    {
        return Setting::leftJoin('user_setting', function($join) use($userId){
            $join->on('user_setting.setting_id', 'settings.id')->where('user_setting.user_id', $userId);
        });
    }

    private static function findOrCreate(int $userId, int $settingId): UserSetting
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
