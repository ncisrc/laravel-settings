<?php

namespace Nci\SettingsPackage\Business;

use Nci\SettingsPackage\Classes\App;
use stdClass;

class AppSettingBusiness
{
    public static function appSettingSearch(array $data): array
    {
        $data['scope'] = 'App';

        return App::settings($data);
    }

    public static function appSettingFind(int $settingId): stdClass
    {
        return App::setting($settingId);
    }
}