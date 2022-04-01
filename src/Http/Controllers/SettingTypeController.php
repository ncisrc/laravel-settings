<?php

namespace Nci\SettingsPackage\Http\Controllers;

use Exception;
use Nci\SettingsPackage\Business\SettingBusiness;

class SettingTypeController extends Controller
{
    public function index()
    {
        try {
            return SettingBusiness::getTypes();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}