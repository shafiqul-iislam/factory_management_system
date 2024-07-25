<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadHelpers();
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


    protected function loadHelpers()
    {
        //load all helpers at once 
        foreach (glob(__DIR__ . '/../Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }
}
// register on app.php (App\Providers\HelperServiceProvider::class,) 