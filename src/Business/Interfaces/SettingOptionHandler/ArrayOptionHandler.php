<?php

namespace Nci\Settings\Business\Interfaces\SettingOptionHandler;

class ArrayOptionHandler implements OptionHandler
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