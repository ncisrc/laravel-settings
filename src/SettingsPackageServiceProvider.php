<?php

namespace Nci\SettingsPackage;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SettingsPackageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'settingspackage');
    }

    public function boot()
    {
        Route::group(['middleware'  => config('settingspackage.middleware')], function() {
            $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        });

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('settingspackage.php'),
            ], 'config');
        }
    }
}