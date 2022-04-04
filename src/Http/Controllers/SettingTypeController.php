<?php

namespace Nci\Settings²\Http\Controllers;

use Exception;
use Nci\Settings\Business\SettingBusiness;

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