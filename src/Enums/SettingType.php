<?php

namespace Nci\Settings\Enums;

enum SettingType: string
{
    case Boolean = 'boolean';
    case Number  = 'number';
    case String  = 'string';
    case Array   = 'array';
    case Json    = 'json';
}