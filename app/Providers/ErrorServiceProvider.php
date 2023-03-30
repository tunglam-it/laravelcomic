<?php

namespace App\Providers;

use App\View\Composers\ErrorComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ErrorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('errors.404', ErrorComposer::class);
    }
}
