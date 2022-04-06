<?php

namespace Nci\Settings\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nci\Settings\Business\SettingBusiness;
use Nci\Settings\Business\UserSettingBusiness;

class UserSettingController extends Controller
{
    public function index(int $userId)
    {
        if (!DB::table('users')->where('id', $userId)->first()->exists()) {
            throw new Exception('User not found.');
        }
        try {
            return UserSettingBusiness::get($userId);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function store(Request $request, int $userId, int $settingId)
    {
        $data = $request->validate([
            'value'      => 'required|string',
        ]);

        try {
            $setting = SettingBusiness::find($settingId);

            return UserSettingBusiness::setValue($data['user_id'], $setting->id, $data['value']);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}