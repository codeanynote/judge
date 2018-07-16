<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Libraries\ControllerHelper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
//        view()->share('config', ControllerHelper::getConfig());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
