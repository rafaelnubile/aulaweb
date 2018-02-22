<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class echoFormat extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        \Blade::setEchoFormat('nl2br(e(%s))');        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
