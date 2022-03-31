<?php

use Illuminate\Support\Facades\Route;
use Nci\SettingsPackage\Http\Controllers\UserSettingController;
use Nci\SettingsPackage\Http\Controllers\SettingController;
use Nci\SettingsPackage\Http\Controllers\SettingOptionController;

// Setting
Route::get('/settings',     [SettingController::class, 'index']);
Route::get('/setting/{id}', [SettingController::class, 'show']);
Route::put('/setting/{id}', [SettingController::class, 'update']);

// SettingOptions
Route::get('/setting/options', [SettingOptionController::class, 'index']);

// UserSetting
Route::get('/settings/user/{id}',                 [UserSettingController::class, 'index']);
Route::post('/setting/{settingId}/user/{userId}', [UserSettingController::class, 'store']);