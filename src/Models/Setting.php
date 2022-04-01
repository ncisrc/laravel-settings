<?php

namespace Nci\SettingsPackage\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nci\SettingsPackage\Enums\SettingType;
use Nci\SettingsPackage\Database\Factories\SettingFactory;
use Nci\SettingsPackage\Enums\ErrorText;

class Setting extends Model
{
    use HasFactory;

    private array $options = [];

    protected $appends = ['options'];

    protected $casts = [
        'type' => SettingType::class
    ];

    public function getOptions(string $value = null): array
    {
        $data = is_null($value) ? $this->options_data : $value;
        if (empty($this->options_class) || empty($data)) {
            return [];
        }

        $optionHandler = new $this->options_class();

        return $optionHandler->process($data);
    }

    public function checkOptions(string $value): void
    {
        if (empty($this->options_class)) return;

        $optionHandler = new $this->options_class();
        if (!$optionHandler->canCheckOptions()) return;

        $isSimpleType = in_array($this->type, [SettingType::Boolean, SettingType::Number, SettingType::String]);
        $needle       = ($isSimpleType) ? $value : json_decode($value);
        $options      = $optionHandler->process($this->options_data);

        if (!in_array($needle, $options)) {
            throw new Exception(ErrorText::API_E_SETTING01, 404);
        }
    }

    public function getOptionsAttribute()
    {
        return $this->options;
    }

    protected function optionsData(): Attribute
    {
        $set = function($value) {
            $this->options = $this->getOptions($value);
            return $value;
        };
        return Attribute::make(
            get: fn ($value) => $value,
            set: $set,
        );
    }

    protected static function newFactory()
    {
        return new SettingFactory();
    }

    protected static function booted()
    {
        static::retrieved(function(Setting $setting) {
            $setting->options = $setting->getOptions();
        });
    }
}
