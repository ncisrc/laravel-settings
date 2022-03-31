<?php

namespace Nci\SettingsPackage\Traits;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Nci\SettingsPackage\Business\UserSettingBusiness;
use Nci\SettingsPackage\Models\Setting;

trait UserHasSettings
{
    public function getSettings(): Collection
    {
        return UserSettingBusiness::get($this->id);
    }

    public function getSetting(string $code): string
    {
        return UserSettingBusiness::getValue($this->id, $code);
    }

    public function getSettingById(int $userId): Setting
    {
        return UserSettingBusiness::find($this->id, $userId);
    }

    public function getSettingByCode(string $code): Setting
    {
        return UserSettingBusiness::findByCode($this->id, $code);
    }

    public function setSetting(int $settingId, string $value): bool
    {
        try {
            return UserSettingBusiness::setValue($this->id, $settingId, $value);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 404);
        }
    }
}