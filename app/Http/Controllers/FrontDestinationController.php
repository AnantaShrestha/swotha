<?php

namespace App\Http\Controllers;

use App\Destinations;

class FrontDestinationController extends Controller
{
    public function show($slug){

//        $recent = array_unique($request->session()->get('recent.trips'));
//
//
//        $recentTrips = Trips::find($recent);
//
//        dd($recentTrips);
        $destination = Destinations::where('slug','=',$slug)->first();
        return view('frontend.destinations.index',compact('destination'));
    }
}
