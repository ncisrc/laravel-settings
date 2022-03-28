<?php

namespace Nci\SettingsPackage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nci\SettingsPackage\Enums\SettingType;
use Nci\SettingsPackage\Database\Factories\SettingFactory;

class Setting extends Model
{
    use HasFactory;

    protected $casts = [
        'type' => SettingType::class
    ];

    public function options()
    {
        return (is_null($this->json_options)) ? null : json_decode($this->json_options);
    }

    protected static function newFactory()
    {
        return new SettingFactory();
    }
}
