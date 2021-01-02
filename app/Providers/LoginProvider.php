<?php

namespace App\Providers;

use App\Http\Controllers\Login;
use App\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class LoginProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('LoginService', function () {
            return new LoginService;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
