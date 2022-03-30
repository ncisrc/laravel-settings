<?php

namespace Nci\SettingsPackage\Traits;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Nci\SettingsPackage\Business\UserSettingBusiness;
use Nci\SettingsPackage\Models\Setting;

trait UserHasSettings
{
    public function settings(): Collection
    {
        return UserSettingBusiness::get($this->id);
    }

    public function setting(int $settingId): Setting
    {
        return UserSettingBusiness::find($this->id, $settingId);
    }

    public function settingByCode(string $code): Setting
    {
        return UserSettingBusiness::findByCode($this->id, $code);
    }

    public function setSetting(int $settingId, string $value): bool
    {
        try {
            return UserSettingBusiness::setValue([
                'user_id'    => $this->id,
                'setting_id' => $settingId,
                'value'      => $value
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 404);
        }
    }
}