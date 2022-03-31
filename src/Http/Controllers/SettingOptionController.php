<?php

namespace Nci\SettingsPackage\Http\Controllers;

use Exception;
use Nci\SettingsPackage\Business\SettingBusiness;

class SettingOptionController extends Controller
{
    public function index()
    {
        try {
            return SettingBusiness::getOptionsClass();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}