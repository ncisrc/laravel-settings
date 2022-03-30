<?php

namespace Nci\SettingsPackage\Business\Interfaces\SettingOptionHandler;

class SettingOptionHandlerList
{
    const EXCLU_ARY = [".","..","SettingOptionHandlerList.php","OptionHandler.php"];

    public static function get()
    {
        $result    = [];
        $fileList  = scandir(__DIR__ . "/");

        foreach ($fileList as $key => $value) {
            if (!in_array($value, self::EXCLU_ARY)) {
                $result[] = __NAMESPACE__ . "\\" . str_replace(".php", "", $value);
            }
        }
        return $result;
    }
}