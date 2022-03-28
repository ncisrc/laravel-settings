<?php

use Illuminate\Support\Facades\Route;
use Nci\SettingsPackage\Http\Controllers\UserSettingController;
use Nci\SettingsPackage\Http\Controllers\AppSettingController;
use Nci\SettingsPackage\Http\Controllers\SettingController;

// Setting
Route::get('/settings',     [SettingController::class, 'index']);
Route::get('/setting/{id}', [SettingController::class, 'show']);
Route::put('/setting/{id}', [SettingController::class, 'update']);

// UserSetting
Route::get('/user/{id}/settings',                 [UserSettingController::class, 'index']);
Route::get('/user/{userId}/setting/{settingId}',  [UserSettingController::class, 'show']);
Route::post('/user/{userId}/setting/{settingId}', [UserSettingController::class, 'store']);

// AppSetting
Route::get('/app/settings',             [AppSettingController::class, 'index']);
Route::get('/app/setting/{settingId}',  [AppSettingController::class, 'show']);
Route::post('/app/setting/{settingId}', [AppSettingController::class, 'store']);