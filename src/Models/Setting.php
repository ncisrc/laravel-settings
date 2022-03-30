<?php

namespace Nci\SettingsPackage\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nci\SettingsPackage\Enums\SettingType;
use Nci\SettingsPackage\Database\Factories\SettingFactory;
use Nci\SettingsPackage\Enums\ErrorText;

class Setting extends Model
{
    use HasFactory;

    protected $casts = [
        'type' => SettingType::class
    ];

    public function getOptions(): array
    {
        if (empty($this->options_class)) {
            return [];
        }

        $optionHandler = new $this->options_class();

        return $optionHandler->process($this->options_data);
    }

    public function checkOptions(string $value): void
    {
        if (!empty($this->options_class)) {
            $optionHandler = new $this->options_class();
            if ($optionHandler->canCheckOptions()) {
                $needle = (in_array($this->type, [SettingType::Boolean, SettingType::Number, SettingType::String])) ?
                    $value : json_decode($value);
                if (!in_array($needle, $optionHandler->process($this->options_data))) {
                    throw new Exception(ErrorText::API_E_SETTING01, 404);
                }
            }
        }
    }

    protected static function newFactory()
    {
        return new SettingFactory();
    }
}
