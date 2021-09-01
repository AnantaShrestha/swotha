<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EnquiryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->enquiry();
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

    public function enquiry()
    {
        view()->composer('layouts.enquiry', 'App\Http\Composers\Enquiry');
        view()->composer('layouts.indexEnquiry', 'App\Http\Composers\Enquiry');
        view()->composer('layouts.brochureform', 'App\Http\Composers\Enquiry');
    }
}
