<?php

namespace Nci\SettingsPackage\Traits;

use Exception;
use Illuminate\Support\Facades\DB;
use Nci\SettingsPackage\Enums\ErrorText;
use Nci\SettingsPackage\Enums\SettingType;
use Nci\SettingsPackage\Models\Setting;
use stdClass;

trait HasSettings
{
    public static function settings(array $data = null, int $userId = null): array
    {
        $scope = (is_null($userId)) ? 'App' : 'User';

        $select = 'SELECT s.id, s.namespace, s.scope, s.code, s.description, s.type, s.json_options, s.nullable, s.default_value, s.favorite, s.width, ';
        $select .= (!is_null($userId)) ? ' IFNULL(user_setting.value, s.default_value) ' : ' s.default_value ' . ' AS value ';

        $from  = 'FROM settings AS s';

        $whereAry[] = ' s.scope=:scope ';
        $params['scope'] = $scope;

        if (!is_null($data)) {
            if (array_key_exists('id', $data)) {
                $whereAry[] = ' s.id=:id ';
                $params['id'] = $data['id'];
            }

            if (array_key_exists('namespace', $data)) {
                $whereAry[] = ' s.namespace LIKE :namespace ';
                $params['namespace'] = "%{$data['namespace']}%";
            }

            if (array_key_exists('code', $data)) {
                $whereAry[] = ' s.code=:code ';
                $params['code'] = "%{$data['code']}%";
            }

            if (array_key_exists('favorite', $data)) {
                $whereAry[] = ' s.favorite=:favorite ';
                $params['favorite'] = $data['favorite'];
            }
        }

        if (!is_null($userId)) {
            $from  .= ' LEFT OUTER JOIN user_setting ON user_setting.setting_id=s.id ';
            $whereAry[] = ' user_setting.user_id=:user_id ';
            $params['user_id'] = $userId;
        }

        $where = ' WHERE ' . implode('AND', $whereAry);

        $orderBy = ' ORDER BY s.namespace ';

        $sql = $select . $from . $where . $orderBy;

        $settingsAry = DB::select($sql, $params);

        // populate setting value in case of jsonsql
        foreach ($settingsAry as $setting) {
            if (str_contains($setting->json_options, 'jsonsql')) {
                $data = $setting->options()->data;
                $setting->value = DB::select($data->select . ' ' . $data->from . ' ' . $data->where);
            }
        }

        return $settingsAry;
    }

    public static function setting(int $settingId, int $userId = null): stdClass
    {
        return static::settings(['id' => $settingId], $userId)[0];
    }

    public static function setSetting(int $settingId, string $value, int $userId = null): void
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

        if (!is_null($userId)) {
            // if exists just update
            if (DB::table('user_setting')->where(['user_id' => $userId, 'setting_id' => $setting->id])->exists()) {
                DB::update('UPDATE user_setting SET value=? WHERE user_id=? AND setting_id=?', [$value, $userId, $setting->id]);
                return;
            }
            // if value equals default abort
            if ($setting->default_value === $value) {
                throw new Exception(ErrorText::API_E_SETTING03, 404);
            }
            // either create
            DB::insert('INSERT INTO user_setting (user_id, setting_id, value) values (?, ?, ?)' , [$userId, $setting->id, $value]);
            return;
        }

        $setting->default_value = $value;
        $setting->save();
    }
}