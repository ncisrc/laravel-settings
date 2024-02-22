<?php

namespace Nci\Settings\Traits;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Nci\Settings\Business\UserSettingBusiness;
use Nci\Settings\Models\Setting;

trait UserHasSettings
{

    public function settings()
    {
        return $this->belongsToMany(Setting::class, 'user_setting', 'user_id', 'setting_id')
            ->withPivot('value')
            ->withTimestamps();
    }

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
