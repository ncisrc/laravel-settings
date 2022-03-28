<?php

namespace Nci\SettingsPackage\Http\Controllers;

use Exception;
use Nci\SettingsPackage\Enums\ErrorText;
use Illuminate\Http\Request;

class UserSettingController extends Controller
{
    public function index(Request $request, int $userId)
    {
        if (!is_numeric($userId)) {
            throw new Exception(ErrorText::API_E_PARAM01);
        }
    }

    public function show(int $userId, string $settingAttribute)
    {
        // TODO
    }

    public function store(Request $request, int $userId, int $settingId)
    {
        // TODO
    }
}