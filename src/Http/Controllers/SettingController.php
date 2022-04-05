<?php

namespace Nci\Settings\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Nci\Settings\Business\SettingBusiness;
use Nci\Settings\Enums\ErrorText;
use Nci\Settings\Models\Setting;

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
        $setting = SettingBusiness::find($settingId);
        if (is_null($setting)) {
            throw new Exception(ErrorText::API_E_SETTING02);
        }
        return $setting;
    }

    public function update(Request $request, int $settingId)
    {
        $data = $request->validate([
            'options_class' => 'nullable|string',
            'options_data'  => 'nullable|string',
            'default_value' => 'nullable|string',
            'favorite'      => 'nullable|boolean',
        ]);

        if (count($data) === 0) {
            throw new Exception(ErrorText::API_E_PARAM02);
        }

        $setting = Setting::find($settingId);
        if (is_null($setting)) {
            throw new Exception(ErrorText::API_E_SETTING02);
        }

        try {
            return SettingBusiness::update($setting, $data);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}