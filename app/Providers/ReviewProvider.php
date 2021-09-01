<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ReviewProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->reviews();
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

    public function reviews(){
        view()->composer('layouts.nayareview', 'App\Http\Composers\Review');
    }
}
