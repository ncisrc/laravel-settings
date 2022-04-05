<?php

use Illuminate\Support\Facades\Route;
use Nci\Settings\Http\Controllers\UserSettingController;
use Nci\Settings\Http\Controllers\SettingController;
use Nci\Settings\Http\Controllers\SettingOptionController;
use Nci\Settings\Http\Controllers\SettingTypeController;

// Setting
Route::get('/settings',            [SettingController::class, 'index']);
Route::get('/setting/{settingId}', [SettingController::class, 'show']);
Route::put('/setting/{settingId}', [SettingController::class, 'update']);

// SettingOptions
Route::get('/settings/options', [SettingOptionController::class, 'index']);

// SettingTypes
Route::get('/settings/types', [SettingTypeController::class, 'index']);

// UserSetting
Route::get('/settings/{userId}/user',             [UserSettingController::class, 'index']);
Route::post('/setting/{settingId}/user/{userId}', [UserSettingController::class, 'store']);