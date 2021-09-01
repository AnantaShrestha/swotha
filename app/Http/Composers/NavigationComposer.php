<?php

/**
 * Created by PhpStorm.
 * User: Bhai
 * Date: 4/5/2017
 * Time: 4:09 AM
 */

namespace App\Http\Composers;
use App\About;
use App\Destinations;
use App\Themes;
use App\Trips;
use Illuminate\Contracts\View\View;

class NavigationComposer
{
    public function compose(View $view){
        $view->with('destinations', Destinations::orderBy('position', 'ASC')->select('country_name', 'slug', 'image')
            ->where('position', '!=', NULL)->limit(8)->get());

        $view->with('themes', Themes::orderBy('position', 'ASC')->select('theme_name', 'slug', 'image')
            ->where('position', '!=', NULL)->limit(8)->get());
        $view->with('trips', Trips::with('customtrip')->select('name', 'slug', 'cover_image', 'special_discount')
            ->where('traveldeal', '=', 1)->limit(8)->latest()->get());
        $view->with('abouts', About::orderBy('position', 'ASC')->select('aboutname', 'slug', 'cover_image')
            ->where('position', '!=', NULL)->limit(8)->get());
    }
}