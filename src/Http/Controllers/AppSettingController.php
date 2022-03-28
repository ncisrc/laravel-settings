<?php

namespace Nci\SettingsPackage\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Nci\SettingsPackage\Business\AppSettingBusiness;
use Nci\SettingsPackage\Business\SettingBusiness;
use Nci\SettingsPackage\Enums\ErrorText;
use Nci\SettingsPackage\Models\Setting;

class AppSettingController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'group'    => 'nullable|string',
            'code'     => 'nullable|string',
            'favorite' => 'nullable|boolean',
        ]);

        try {
            return AppSettingBusiness::appSettingSearch($data);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function show(int $settingId)
    {
        $request = new Request();
        $request->request->add([
            'setting_id' => $settingId,
        ]);

        $data = $request->validate([
            'setting_id' => 'required|integer|exists:settings',
        ]);

        try {
            return AppSettingBusiness::appSettingFind($data['setting_id']);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}