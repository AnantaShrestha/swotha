<?php

namespace App\Http\Controllers;

use App\Cities;
use App\CustomTrip;
use App\Destinations;
use App\Duplicate;
use App\Themes;
use App\TravelStyles;
use App\TripDates;
use App\TripFaq;
use App\TripItenaries;
use App\Trips;
use Illuminate\Http\Request;

class DuplicateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$trip = Duplicate::where('id', $id)->first();
	    return view('admin-panel.Trips.showDuplicate',compact('trip'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $trips = Duplicate::findOrFail($id);
	    $styles = TravelStyles::all();
	    $themes = Themes::all();
	    $cities = Cities::all();
	    $countries = Destinations::all();
	    return view('admin-panel.Trips.editDuplicate',
		    compact('trips','styles','themes','cities','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
	    $input = $request->all();
	    
	    $cover_image = Duplicate::select('cover_image')->where('id', $id)->first();
	    
	    $cities = Cities::find($input['cities']);
	    $countriies = Destinations::find($input['countries']);
	    $themes = Themes::find($input['themes']);
	    $style = TravelStyles::find($input['s_id']);
	    $slug =  str_slug($input['name'], '-');
	    $season = $input['seasons'];
	    $str = [];
	    $str1 = [];
	    $str2 = [];
	    $str3 = [];
	
	    $count = 0;
	    $input['slug'] = $slug;
	
	    /*code for auto genrating code for trip */
	    $nameoftrip = explode(' ',$input['name']);
	    $codename=[];
	    foreach ($nameoftrip as $one){
		    $piece = substr($one,0,1);
		    array_push($codename, strtoupper($piece));
	    }
	    $codeoftrip = implode('',$codename);
	    $daysofthetrip = $input['days'];
	    if($daysofthetrip < 10){
		    $showdays = '0'.$daysofthetrip;
	    }else{
		    $showdays = $daysofthetrip;
	    }
	    $manyday = str_split($showdays);
	    $uppercode =$manyday[1].$manyday[0];
	    $lowercode = $manyday[0].$manyday[1];
	    $meronew = round(($uppercode % $lowercode)) + 13;
	
	    if($daysofthetrip < 10){
		    $nakalliday = $daysofthetrip + 13;
		    $meronew = $meronew + $nakalliday;
	    }
	    if($meronew < 50){
		    $maindays= str_split($meronew);
		    $daysccode = $maindays[1].$maindays[0];
	    }else{
		    $maindays= str_split($meronew);
		    $daysccode = $maindays[0].$maindays[1];
	    }
	
	    $input['code'] = $codeoftrip.$daysccode;
	    /* end for code for trips */
	    
	    foreach ($cities as $city){
		    $str[$count++] = $city->name;
	    }
	    foreach ($countriies as $country){
		    $str3[$count++] = $country->country_name;
	    }
	
	    $str1[$count++] = $style->name;
	
	    foreach ($themes as $theme){
		    $str2[$count++] = $theme->theme_name;
	    }
//        dd($str);
	    $countries = implode(',',$str3);
	    $city = implode(',',$str);
	    $style = implode(',',$str1);
	    $theme = implode(',',$str2);
//        dd($city,$style,$theme,$countries);
	    $input['regions'] = $city;
	    $input['country'] = $countries;
	    $input['style'] = $style;
	    $input['seasons'] = $season;
	    $input['ventures'] = $theme;
	    $itenaries = TripItenaries::where('trip_id', $id)->get();
//        $input['altitude'] = 100.3;
//        return $image;
	
	    //Copying the previous image and renaming it
	    $old = public_path('/images/trips/cover//').$cover_image->cover_image;
	
	    $newImageName = 'file-'.rand(0,999).time().'.'.pathinfo($old, PATHINFO_EXTENSION);
	
	    $new = public_path('/images/trips/cover//').$newImageName;
	
	    copy($old, $new);
	    copy(public_path('/images/trips//').$cover_image->cover_image, public_path('/images/trips//').$newImageName);
	    copy(public_path('/images/trips/thumbnail//').$cover_image->cover_image, public_path('/images/trips/thumbnail//').$newImageName);
	    
		$trips = Trips::create($input);
	
	    $trips->cover_image = $newImageName;
	    
	    $trips->save();
		
	    $trips->cities()->attach($request->input('cities'));
	    $trips->themes()->attach($request->input('themes'));
	    $trips->countries()->attach($request->input('countries'));
	    
	    $itenaries = TripItenaries::where('trip_id', $id)->get();
	    
	    //Copying Ttrip Itenaries
	    foreach($itenaries as $itenary){
	    	$newItenary = $itenary->replicate()->toArray();
	    	$newItenary['trip_id'] = $trips->id;
	    	TripItenaries::create($newItenary);
	    }
	
	    $dates = TripDates::where('trip_id', $id)->get();
	
	    foreach($dates as $date){
	    	$newDate = $date->replicate()->toArray();
	    	$newDate['trip_id'] = $trips->id;
	    	$newDate['start_date'] = date('Y-m-d',strtotime($newDate['start_date']));
	    	TripDates::create($newDate);
	    }
	    
	    //Copying Trip FAQs
	    $faqs = TripFaq::where('trip_id', $id)->get();
	    
	    foreach($faqs as $faq){
	    	$newFaq = $faq->replicate()->toArray();
	    	$newFaq['trip_id'] = $trips->id;
	    	TripFaq::create($newFaq);
	    }
	    
	    //Copying Custom Trips
	    
	    $customTrip = CustomTrip::where('trip_id', $id)->first();
	    
	    if(!is_null($customTrip)){
		    $newTrip = $customTrip->replicate()->toArray();
		    $newTrip['trip_id'] = $trips->id;
		    CustomTrip::create($newTrip);
	    }
	    
	    Duplicate::where('id', $id)->delete();
	    
	    return redirect('/backend/trips');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = Duplicate::where('id', $id)->first();
        $del->delete();
	    return redirect('/backend/trips')->with('success', 'Duplicated Trip Deleted successfully.');
    }
	
	public function duplicate($id){
		$copiedTrip = Trips::where('id', $id)->first();
		$copy = new Duplicate();
		
		$newCopy = $copiedTrip->replicate()->toArray();
		$newCopy['name'] = "Copy - ".$newCopy['name'];
		$newCopy['id'] = $id;
		$copy->create($newCopy);
		return redirect('/backend/trips');
	}
}
