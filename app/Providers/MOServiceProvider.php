<?php

namespace App\Providers;

use App\Facades\MO;
use Illuminate\Support\ServiceProvider;

class MOServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        MO::immigrationValidator();
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
