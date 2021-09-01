<?php

namespace App\Http\Controllers;

use App\Cities;

class FrontCityController extends Controller
{
    public function show($slug){
        $city = Cities::where('slug','=',$slug)->first();
        return view('frontend.region.index',compact('city'));
    }
}
