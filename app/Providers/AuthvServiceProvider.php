<?php

namespace App\Providers;

use App\Facades\Authv;
use Illuminate\Support\ServiceProvider;

class AuthvServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Authv::immigrationValidator();
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
