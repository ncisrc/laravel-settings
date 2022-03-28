<?php

namespace Nci\SettingsPackage\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Nci\SettingsPackage\Business\UserSettingBusiness;

class UserSettingController extends Controller
{
    public function index(Request $request, int $userId)
    {
        $request->request->add(['user_id' => $userId]);

        $data = $request->validate([
            'user_id'  => 'required|integer|exists:users',
            'group'    => 'nullable|string',
            'code'     => 'nullable|string',
            'favorite' => 'nullable|boolean',
        ]);

        try {
            return UserSettingBusiness::userSettingSearch($data);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function show(int $userId, int $settingId)
    {
        $request = new Request();
        $request->request->add([
            'user_id'    => $userId,
            'setting_id' => $settingId,
        ]);

        $data = $request->validate([
            'user_id'    => 'required|integer|exists:users',
            'setting_id' => 'required|integer|exists:settings',
        ]);

        try {
            return UserSettingBusiness::userSettingFind($data['user_id'], $data['setting_id']);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function store(Request $request, int $userId, int $settingId)
    {
        $request->request->add([
            'user_id'    => $userId,
            'setting_id' => $settingId,
        ]);

        $data = $request->validate([
            'user_id'    => 'required|integer|exists:users',
            'setting_id' => 'required|integer|exists:settings',
            'value'      => 'required|string',
        ]);

        try {
            return UserSettingBusiness::userSettingSetValue($data);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}