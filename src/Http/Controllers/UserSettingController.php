<?php

namespace Nci\SettingsPackage\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Nci\SettingsPackage\Business\UserSettingBusiness;

class UserSettingController extends Controller
{
    public function index(int $userId)
    {
        $request = static::getNewRequest(['user_id' => $userId]);
        $request->validate([
            'user_id'    => 'required|integer|exists:users',
        ]);

        try {
            return UserSettingBusiness::get($userId);
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
            return UserSettingBusiness::setValue($data);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}