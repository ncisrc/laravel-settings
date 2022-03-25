<?php

namespace Nci\SettingsPackage\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            '' => ''
        ]);
    }

    public function show(string $settingAttribute)
    {
        // TODO
    }

    public function store(Request $request, int $settingId)
    {
        // TODO
    }
}