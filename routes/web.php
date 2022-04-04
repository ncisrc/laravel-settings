<?php

use Illuminate\Support\Facades\Route;
use Nci\Settings\Http\Controllers\UserSettingController;
use Nci\Settings\Http\Controllers\SettingController;
use Nci\Settings\Http\Controllers\SettingOptionController;
use Nci\Settings\Http\Controllers\SettingTypeController;

// Setting
Route::get('/settings',     [SettingController::class, 'index']);
Route::get('/setting/{id}', [SettingController::class, 'show']);
Route::put('/setting/{id}', [SettingController::class, 'update']);

// SettingOptions
Route::get('/setting/options', [SettingOptionController::class, 'index']);

// SettingTypes
Route::get('/setting/types', [SettingTypeController::class, 'index']);

// UserSetting
Route::get('/settings/user/{id}',                 [UserSettingController::class, 'index']);
Route::post('/setting/{settingId}/user/{userId}', [UserSettingController::class, 'store']);