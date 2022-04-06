<?php

namespace Nci\Settings\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Nci\Settings\Business\UserSettingBusiness;

class UserSettingController extends Controller
{
    public function index(Request $request, int $userId)
    {
        $request->request->add([
            'user_id' => $userId
        ]);

        $request->validate([
            'user_id'    => 'required|integer|exists:users'
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
            return UserSettingBusiness::setValue($data['user_id'], $data['setting_id'], $data['value']);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}