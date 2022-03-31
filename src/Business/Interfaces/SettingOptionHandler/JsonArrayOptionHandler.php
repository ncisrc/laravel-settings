<?php

namespace Nci\SettingsPackage\Business\Interfaces\SettingOptionHandler;

class JsonArrayOptionHandler implements OptionHandler
{
    public function process(string $data): array
    {
        return (empty($data)) ? [] : json_decode($data);
    }

    public function canCheckOptions(): bool
    {
        return true;
    }
}