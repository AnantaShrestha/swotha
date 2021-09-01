<?php

namespace App\Http\Controllers;

use App\Cities;
use App\Destinations;
use App\Trips;
use Illuminate\Http\Request;

class FrontFilterController extends Controller
{
	public function filter1(Request $request){
		$destination_id = $request->destination_id;
		$destination = Destinations::findOrFail($destination_id);
		$cities = $destination->cities;
		$trips  = $destination->trips;
		
		$mindays = $trips->min('days');
		$maxdays = $trips->max('days');
		
		$minprice = $trips->min('price');
		$maxprice = $trips->max('price');
		
		return response()->json(['cities' => $cities,'mindays'=>$mindays,'maxdays'=>$maxdays,'minprice'=>$minprice, 'maxprice'=>$maxprice]);
	}
	
	public function filter2(Request $request){
		$city_id = $request->city_id;
		$cities = Cities::findOrFail($city_id);
		$trips  = $cities->trips;
		
		$mindays = $trips->min('days');
		$maxdays = $trips->max('days');
		
		$minprice = $trips->min('price');
		$maxprice = $trips->max('price');
		
		return response()->json(['mindays'=>$mindays,'maxdays'=>$maxdays,'minprice'=>$minprice, 'maxprice'=>$maxprice]);
	}
	
	public function filter3(Request $request){
		$days  = $request->days;
		$trips = Trips::where('days','<=',$days)->get();
		$minprice = $trips->min('price');
		$maxprice = $trips->max('price');
		
		return response()->json(['minprice'=>$minprice, 'maxprice'=>$maxprice]);
	}
	
	public function searchresult(Request $request){
		$input = $request->all();
		
		if($input['destination_id'] != null){
			$destination = Destinations::findOrFail($input['destination_id']);
			$trips = $destination->trips;
		}
		
		if($input['city_id'] != null){
			$cities = Cities::findOrFail($input['city_id']);
			$trips = $cities->trips;
		}
		
		if($input['duration_id'] != null){
			$trips = $trips->where('days','<=',$input['duration_id']);
		}
		
		if($input['price_range'] != null){
			$trips = $trips->where('price','<=',$input['price_range']);
		}
		return view('frontend.searchresult',compact('trips'));
	}
}
