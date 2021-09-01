<?php

namespace App\Http\Controllers;

use App\Articles;
use App\CoverImage;
use App\CustomTrip;
use App\TripDates;
use App\Trips;

class IndexController extends Controller
{
    public function index(){
//	    $minutes = 100;
//    	$start = microtime(true);
	
//	    = Cache::remember('featuredTrips', $minutes, function () {
//		     return
//	    });
	    $featuredTrips = Trips::orderBy('poplularity','desc')->limit(9)->latest()->get();
	
//	     = Cache::remember('latestOffers', $minutes, function () {
//		    return
//	    });
	
	    $latestOffers = Trips::where('hidden_gem','=','1')->limit(9)->latest()->get();
//	    $beyondBorders = Cache::remember('beyondBorders', $minutes, function () {
	    
	    $customtrip = CustomTrip::where('beyond_border','=',1)->limit(9)->get();
	    
	    $beyondBorders = [];
	    foreach ($customtrip as $tp){
	    	$trips = Trips::find($tp->trip_id);
	    	array_push($beyondBorders, $trips);
	    }

	    
	    $video = CoverImage::where('is_video', 1)->first();
	   
	    if(is_null($video)) {
		    $coverimageone = CoverImage::where([['is_parallax', 0], ['is_video', 0]])->orderBy('rank')->get();
	    }
	    
	    //Simple change
	    
//	    dd($coverimageone);
	    
	    $pi = CoverImage::select('image', 'is_parallax')->where('is_parallax', '!=', 0)->orderBy('is_parallax', 'asc')->get();
	    
	    $parallax = array();
	    
	    foreach($pi as $para){
	    	$parallax[$para->is_parallax] = $para->image;
	    }

	    $dates = TripDates::all();
	    $id = [];
	    $count = 0;
	    foreach ($dates as $date){
		    if(strtotime($date->start_date) < strtotime('-3 month ago')
			    and strtotime($date->start_date) > strtotime('now') and $date->discount != null) {
			    $id[$count++] = $date->id;
		    }
	    }
	    $lastDeal= TripDates::orderBy('start_date','asc')->limit(8)->find($id);

	    $allblogs = Articles::where('is_published','=',1)->get();
        
        return view('frontend.index',compact('featuredTrips','latestOffers','coverimageone','parallax','feedbacks','lastDeal','video','beyondBorders','allblogs'));
    }
}
