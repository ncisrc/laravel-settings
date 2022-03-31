<?php

namespace Nci\SettingsPackage\Enums;

class ErrorText
{
    // Parameters
    const API_E_PARAM01 = 'API-E-PARAM01: Invalide parameter, integer expected.';
    const API_E_PARAM02 = 'API-E-PARAM02: Nothing to update.';

    // Settings
    const API_E_SETTING01 = 'API-E-SETTING01: Setting\'s value not available.';
    const API_E_SETTING02 = 'API-E-SETTING02: Setting not found.';
    const API_E_SETTING03 = 'API-E-SETTING03: The value you are trying to add is the same that default.';
    const API_E_SETTING04 = 'API-E-SETTING04: The value of this setting cannot be override.';
    const API_E_SETTING05 = 'API-E-SETTING05: Setting options handler class not found.';
}