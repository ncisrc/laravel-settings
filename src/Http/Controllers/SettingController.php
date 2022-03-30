<?php

namespace Nci\SettingsPackage\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Nci\SettingsPackage\Business\SettingBusiness;
use Nci\SettingsPackage\Enums\ErrorText;
use Nci\SettingsPackage\Models\Setting;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'scope'    => 'nullable|string',
            'group'    => 'nullable|string',
            'code'     => 'nullable|string',
            'favorite' => 'nullable|boolean',
        ]);

        try {
            return SettingBusiness::get($data);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function show(int $settingId)
    {
        if (!is_numeric($settingId)) {
            throw new Exception(ErrorText::API_E_PARAM01);
        }

        try {
            return SettingBusiness::find($settingId);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function update(Request $request, int $settingId)
    {
        $request->request->add(['setting_id' => $settingId]);
        $data = $request->validate([
            'setting_id'    => 'required|integer|exists:settings',
            'json_options'  => 'nullable|string',
            'default_value' => 'nullable|string',
            'favorite'      => 'nullable|boolean',
        ]);

        if (count($data) === 0) {
            throw new Exception(ErrorText::API_E_PARAM02);
        }

        try {
            return SettingBusiness::update($settingId, $data);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}