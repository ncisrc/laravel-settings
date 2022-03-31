<?php

namespace Nci\SettingsPackage\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Nci\SettingsPackage\Business\SettingBusiness;
use Nci\SettingsPackage\Enums\ErrorText;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'overridable' => 'nullable|boolean',
            'code'        => 'nullable|string',
            'favorite'    => 'nullable|boolean',
        ]);

        try {
            return SettingBusiness::get($data);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function show(int $settingId)
    {
        $request = $this->getNewRequest(['setting_id' => $settingId]);
        $request->validate([
            'setting_id'    => 'required|integer|exists:settings',
        ]);

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
            'options_class' => 'nullable|string',
            'options_data'  => 'nullable|string',
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