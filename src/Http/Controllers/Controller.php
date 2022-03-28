<?php

namespace Nci\SettingsPackage\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getNewRequest(array $data = null): Request
    {
        $request = new Request();

        if (!is_null($data)) {
            $request->request->add($data);
        }

        return $request;
    }
}