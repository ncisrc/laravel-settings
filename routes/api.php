<?php

use Illuminate\Support\Facades\Route;
use Nci\Settings\Http\Controllers\UserSettingController;
use Nci\Settings\Http\Controllers\SettingController;
use Nci\Settings\Http\Controllers\SettingOptionController;
use Nci\Settings\Http\Controllers\SettingTypeController;

// Setting
Route::get('/settings',     [SettingController::class, 'index']);
Route::get('/settings/{id}', [SettingController::class, 'show']);
Route::put('/settings/{id}', [SettingController::class, 'update']);

// SettingOptions
Route::get('/settings/options', [SettingOptionController::class, 'index']);

// SettingTypes
Route::get('/settings/types', [SettingTypeController::class, 'index']);

Route::get('/settings/test', function() {
    return 'TEST';
});

// UserSetting
Route::get('/settings/user/{id}',                 [UserSettingController::class, 'index']);
Route::post('/settings/{settingId}/user/{userId}', [UserSettingController::class, 'store']);