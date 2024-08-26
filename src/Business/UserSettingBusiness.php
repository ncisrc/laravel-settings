<?php

namespace Nci\Settings\Business;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Nci\Settings\Models\Setting;
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
        $value = DB::table('user_setting')
            ->join('settings', 'user_setting.setting_id', '=', 'settings.id')
            ->where('user_setting.user_id', $userId)
            ->where('settings.code', $code)
            ->pluck('user_setting.value')
            ->first();

        if (empty($value)) $value = SettingBusiness::getValue($code);

        return empty($value) ? '' : $value;
    }

    public static function setValue(int $userId, int $settingId, string $value): bool
    {
        $setting = static::find($userId, $settingId);

        if (!$setting->overridable) {
            throw new Exception(ErrorText::API_E_SETTING04, 404);
        }

        try {
            $setting->checkOptions($value);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 404);
        }

        DB::table('user_setting')
            ->updateOrInsert(
                ['user_id' => $userId, 'setting_id' => $settingId],
                ['value' => $value]
            );

        return true;
    }

    private static function getQuery(int $userId)
    {
        return Setting::leftJoin('user_setting', function($join) use($userId){
            $join->on('user_setting.setting_id', 'settings.id')->where('user_setting.user_id', $userId);
        });
    }
}
