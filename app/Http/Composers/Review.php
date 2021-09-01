<?php
/**
 * Created by PhpStorm.
 * User: sushil
 * Date: 5/10/17
 * Time: 5:07 PM
 */

namespace App\Http\Composers;


use App\CoverImage;
use App\Reviews;
use App\Trips;
use Illuminate\Contracts\View\View;

class Review
{
    public function compose(View $view){
        $view->with('reviews', Reviews::with('trip', 'user')->where('is_accepted', '=', 1)
            ->orderBy('overall','desc')->latest()->get())
            ->with('trips', Trips::select('name', 'slug')->get())
	        ->with('parallax', CoverImage::select('image')->where('is_parallax','=',3)->first());
    }
}