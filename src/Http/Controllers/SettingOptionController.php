<?php

namespace Nci\SettingsPackage\Http\Controllers;

use Exception;
use Nci\SettingsPackage\Business\SettingBusiness;

class SettingOptionController extends Controller
{
    public function index()
    {
        try {
            return SettingBusiness::getOptionsClass();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function show(int $settingId)
    {
        $request = static::getNewRequest(['setting_id' => $settingId]);
        $request->validate([
            'setting_id' => 'required|integer|exists:settings',
        ]);

        try {
            return SettingBusiness::getOptions($settingId);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}