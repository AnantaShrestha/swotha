<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeNavigation();
        $this->composeNavigation2();
        $this->composeNavigation3();
        $this->composeReview();
        $this->composeRecentTrips();

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

    /**
     * Generate Navigation
     */
    public function composeNavigation(){
        view()->composer('layouts.navbar','App\Http\Composers\NavigationComposer');

    }
     public function composeNavigation2(){
        view()->composer('layouts.navbar2','App\Http\Composers\NavigationComposer');

    }
    public function composeNavigation3(){
        view()->composer('layouts.tripnavbar','App\Http\Composers\NavigationComposer');

    }

    public function composeReview()
    {
//        view()->composer('frontend.tripPage.index','App\Http\Composers\ReviewComposer');
        view()->composer('layouts.reviewForm','App\Http\Composers\ReviewComposer');
    }

    public function composeRecentTrips(){
        view()->composer('frontend.indexlayout.recentviewed','App\Http\Composers\RecentView');
    }
}
