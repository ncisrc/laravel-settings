<?php

namespace Nci\Settings\Http\Controllers;

use Exception;
use Nci\Settings\Business\SettingBusiness;

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