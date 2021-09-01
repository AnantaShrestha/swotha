<?php

namespace App\Http\Controllers;

use App\Cities;
use App\CustomTrip;
use App\Destinations;
use App\Duplicate;
use App\ExtraPackage;
use App\Helper\PasswordChecker;
use App\Http\Requests\TripChangeImageRequest;
use App\Http\Requests\TripCreateRequest;
use App\Http\Requests\TripEditRequest;
use App\Themes;
use App\TravelStyles;
use App\Trips;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use ImageOptimizer;
use Intervention\Image\Facades\Image;
use JD\Cloudder\Facades\Cloudder;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class TripsController extends Controller
{
    public function __construct()
    {
        $this->middleware('optimizeImages');
    }
//    use Searchable;
    public function index(){
        $trips = Trips::orderBy('id','desc')->get();
        $copies = Duplicate::all();
        return view('admin-panel.Trips.index',compact('trips', 'copies'));
    }
//    public function getTrips(){
//        $trips = DB::table('trips')->select('*');
//
//        return Datatables::of($trips)->make(true);
//    }
    public function create(){
        $styles = TravelStyles::all();
        $destination = Destinations::all();
        $cities = Cities::all();
        $themes = Themes::all();
        return view('admin-panel.Trips.createTrips',compact('styles','cities','themes','destination'));
    }
    public function show(Trips $trip){
    	$seo = $trip->seotrip;
    	$allPackages = ExtraPackage::all();
        return view('admin-panel.Trips.showTrips',compact('trip', 'seo', 'allPackages'));
    }
    public function store(TripCreateRequest $request){
        $input = $request->all();
        $cities = Cities::find($input['cities']);
        $style = TravelStyles::find($input['s_id']);
        $countriies = Destinations::find($input['countries']);
        $themes = Themes::find($input['themes']);
//      $styles = TravelStyles::find($input['s_id']);
        $slug =  str_slug($input['name'], '-');
        $str = [];
        $str1 = [];
        $str2 = [];
        $str3 = [];
//        $str4 = [];

        $count = 0;
        $input['slug'] = $slug;

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
        
        $countries = implode(',',$str3);
        $seasons = $input['seasons'];
        $city = implode(',',$str);
        $style = implode(',',$str1);
        $theme = implode(',',$str2);
//        dd($city,$style,$theme,$countries);
        $image = $input['cover_image'];
        $input['regions'] = $city;
        $input['country'] = $countries;
        $input['style'] = $style;
        $input['seasons'] = $seasons;
//        dd($input['style']);
        $input['ventures'] = $theme;
//        $input['altitude'] = 100.3;
//        return $image;
        $filename = $image->getClientOriginalName();
        $input['cover_image'] = $filename;
	    $optimizerChain = OptimizerChainFactory::create();
        Image::make(Request::capture()->file('cover_image'))->save(public_path('/images/trips/' . $filename ));
        Image::make(Request::capture()->file('cover_image'))->resize(789,333)->save( public_path('/images/trips/cover/' . $filename ));
	    Image::make(Request::capture()->file('cover_image'))->resize(435,245)->save( public_path('/images/trips/thumbnail/' . $filename ));

        Cloudder::upload($image, null);
//        list($width, $height) = getimagesize($image);
        $input['image_url']= Cloudder::show(Cloudder::getPublicId(), ["width" => 789, "height"=>333]);
        $input['image_url_thumb']= Cloudder::show(Cloudder::getPublicId(), ["width" => 435, "height"=>245]);

	    $optimizerChain->optimize(public_path('/images/trips/' . $filename ));
	    $optimizerChain->optimize(public_path('/images/trips/cover/' . $filename ));
	    $optimizerChain->optimize(public_path('/images/trips/thumbnail/' . $filename ));
	
	    $trips = Trips::create($input);
	    
	    $trips->cities()->attach($request->input('cities'));
        $trips->themes()->attach($request->input('themes'));
        $trips->countries()->attach($request->input('countries'));
        return redirect('/backend/trips');

    }
    
    public function edit($id){
        $trips = Trips::findOrFail($id);
        $styles = TravelStyles::all();
        $themes = Themes::all();
        $cities = Cities::all();
        $countries = Destinations::all();
        return view('admin-panel.Trips.editTrips',
	        compact('trips','styles','themes','cities','countries'));
    }
    public function update(TripEditRequest $request, $id){
        $trips = Trips::findorFail($id);
        $input = $request->all();
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
//        $input['altitude'] = 100.3;
//        return $image;

        $trips->cities()->sync($request->input('cities'));
        $trips->themes()->sync($request->input('themes'));
        $trips->countries()->sync($request->input('countries'));
        $trips->update($input);
        
        //Pdf Replace
	    $trip = Trips::where('id', $id)->first();
	    $map = null;
	    $gallery = null;
	    if(count($trip->gallery) > 0) {
	        if(!empty($trip->map($trip)->image)) {
                $map = $trip->map($trip)->image;
            }
		    $gallery = $trip->gallery->toArray();
	    }
	
	    $itenary = $trip->itenary->toArray();
	    $data = array(
		    'name' => $trip->name,
		    'cover_image' => $trip->cover_image,
		    'description' => $trip->description,
		    'trip_information' => $trip->trip_information,
		    'map' => $map,
		    'itinerary' => $itenary,
		    'gallery' => $gallery,
		    'inclusions'=> $trip->is_this_trip_right,
		    'complimentary' => $trip->complimentary,
		    'exclusions' => $trip->exclusions,
	    );
	    $pdf = PDF::loadView('admin-panel.layout.itinerary', $data)->setOrientation('landscape')->setPaper('a4');
	
	    if(file_exists(storage_path('trippdf/'.$trip->slug.'.pdf'))){
		    unlink(storage_path('trippdf/'.$trip->slug.'.pdf'));
	    }
	
//	    $pdf->save(storage_path('trippdf/'.$trip->slug.'.pdf'));
     
	    return redirect('/backend/trips');
    }


    public function destroy(Request $request, $id){
    	$input = $request->all();
    	$result = PasswordChecker::checkpass($input['password']);
    	
    	if($result == true){
    		$trip = Trips::where('id', $id)->first();
		    //$file = url('img/trips/'.$trip->cover_image);
		    if(isset($trip->cover_image) && ($trip->cover_image != null)){
			    File::delete(public_path('images/trips/'.$trip->cover_image));
			    File::delete(public_path('images/trips/cover/'.$trip->cover_image));
			    File::delete(public_path('images/trips/thumbnail/'.$trip->cover_image));
		    }
		    $trip->delete();
		
		    return redirect('/backend/trips')->with('success', 'Trip deleted successfully.');
	    } else {
		    return redirect('/backend/trips')->with('error', 'The password you entered is incorrect.');
	    }
     
    }

    public function changeImage(Request $request){
        $input = $request->all();
        $id = $input['id'];
//        return $id;
        return view('admin-panel.Trips.ImageChange',compact('id'));
//        return "I am here";
    }
    public function ImageChange(TripChangeImageRequest $request){
        $input = $request->all();
        // dd($input);
        $image = $input['cover_image'];
        $id = $input['id'];
        $trips = Trips::findOrFail($id);
        File::delete(public_path('/images/trips/'.$trips->cover_image));
        File::delete(public_path('/images/trips/thumbnail/'.$trips->cover_image));
        File::delete(public_path('/images/trips/cover/'.$trips->cover_image));
        // return $image;
        $filename = $image->getClientOriginalName();
        $input['cover_image'] = $filename;
        Image::make(TripChangeImageRequest::capture()->file('cover_image'))->save( public_path('/images/trips/' . $filename ) );
        Image::make(TripChangeImageRequest::capture()->file('cover_image'))->resize(789,333)->save( public_path('/images/trips/cover/' . $filename ));
        Image::make(TripChangeImageRequest::capture()->file('cover_image'))->resize(435,245)->save( public_path('/images/trips/thumbnail/' . $filename ));

        $image_name= explode('.',$image->getClientOriginalName());
        $publicId = $image_name[0];

//        Cloudder::upload($image,['use_filename'=>true]);
        Cloudder::upload($image, $publicId, array("use_filename" => TRUE, "unique_filename"=>FALSE,"format"=>"jpg","folder"=>"trips_image",
            "width" => 789, "height" => 333,"quality"=>"auto"));

//        list($width, $height) = getimagesize($image);
        $input['image_url']= Cloudder::show($publicId, ["width" => 789, "height"=>333]);

        $input['image_url_thumb']= Cloudder::show($publicId, ["width" => 435, "height"=>245]);

        $trips->cover_image = $input['cover_image'];
        $trips->save();
        
        $trips->save();
	
	    $trip = Trips::where('id', $id)->first();
	
	    $map = null;
	    $gallery = null;

//	    dd($trip->map($trip));
	    if(!empty($trip->gallery)){
            if (count($trip->gallery) > 0) {
                $gallery = $trip->gallery->toArray();
            }
            if(!is_null($trip->map($trip))){
                $map = $trip->map($trip)->image;
            }
	    }
	
	    $itenary = $trip->itenary->toArray();
	
	    $data = array(
		    'name' => $trip->name,
		    'cover_image' => $trip->cover_image,
		    'description' => $trip->description,
		    'trip_information' => $trip->trip_information,
		    'map' => $map,
		    'itinerary' => $itenary,
		    'gallery' => $gallery,
		    'inclusions'=> $trip->is_this_trip_right,
		    'complimentary' => $trip->complimentary,
		    'exclusions' => $trip->exclusions,
	    );
	
	
	    $pdf = PDF::loadView('admin-panel.layout.itinerary', $data)->setOrientation('landscape')->setPaper('a4');
	
	    if(file_exists(storage_path('trippdf/'.$trip->slug.'.pdf'))){
		    unlink(storage_path('trippdf/'.$trip->slug.'.pdf'));
	    }
	
	    $pdf->save(storage_path('trippdf/'.$trip->slug.'.pdf'));
        
        return redirect('/backend/trips');

    }
    public function changecustom(Request $request){
    	$input = $request->all();
    	
    	$tripid = $input['tripid'];
    	$val = $input['value'];
    	
    	CustomTrip::where('trip_id','=',$tripid)->update(['showcustom'=>$val]);
	    $data = array();
	    $data[0] = $input['value'];
	    $data[1] = $input['tripid'];
	    return response ()->json ($data);
    }
	
	public function changeForeign(Request $request){
		$input = $request->all();
		
		$tripid = $input['tripid'];
		$val = $input['value'];
		
		CustomTrip::where('trip_id','=',$tripid)->update(['beyond_border'=>$val]);
		$data = array();
		$data[0] = $input['value'];
		$data[1] = $input['tripid'];
		return response ()->json ($data);
	}
}
