<?php

namespace Nci\SettingsPackage\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Nci\SettingsPackage\Business\SettingBusiness;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'group'    => 'nullable|string',
            'scope'    => 'nullable|string',
            'code'     => 'nullable|string',
            'favorite' => 'nullable|boolean',
        ]);

        try {
            return SettingBusiness::settingSearch($data);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function show(int $settingId)
    {
        if (!is_numeric($settingId)) {
            throw new Exception('Invalid parameter.');
        }

        try {
            return SettingBusiness::settingFind($settingId);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function update(Request $request, int $settingId)
    {
        if (!is_numeric($settingId)) {
            throw new Exception('Invalid parameter.');
        }

        $data = $request->validate([
            'json_options' => 'nullable|string',
            'default'      => 'nullable|string',
            'favorite'     => 'nullable|boolean',
        ]);

        if (count($data) === 0) {
            throw new Exception('Nothing to update.');
        }

        try {
            return SettingBusiness::settingFind($settingId);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}