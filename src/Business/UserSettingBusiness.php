<?php

namespace Nci\SettingsPackage\Business;

use Nci\SettingsPackage\Classes\App;
use stdClass;

class UserSettingBusiness
{
    public static function userSettingSearch(array $data): array
    {
        return App::settings($data, $data['user_id']);
    }

    public static function userSettingFind(int $userId, int $settingId): stdClass
    {
        return App::setting($settingId, $userId);
    }

    public static function userSettingSetValue(array $data): stdClass
    {
        App::setSetting($data['setting_id'], $data['value'], $data['user_id']);

        return App::setting($data['setting_id'], $data['user_id']);
    }
}