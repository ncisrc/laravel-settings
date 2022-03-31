<?php

namespace Nci\SettingsPackage\Business\Interfaces\SettingOptionHandler;

interface OptionHandler
{
    public function process(string $data): array;

    public function canCheckOptions(): bool;
}