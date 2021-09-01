<?php

namespace App\Http\Controllers;

use App\Helper\PasswordChecker;
use App\TripPackages;
use App\Trips;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use JD\Cloudder\Facades\Cloudder;

class TripPackageController extends Controller
{
    public function index(){
    	$packages = TripPackages::orderBy('id', 'desc')->get();

    	return view('admin-panel.tripPackages.index', compact('packages'));
    }

    public function create(){
    	return view('admin-panel.tripPackages.create');
    }

    public function store(Request $request){
    	if($request->hasFile('image')){
    		$image = $request->file('image');
//    		$name = time().rand(0,999).'.'.$request->image->extension();
		    $name = $image->getClientOriginalName();
//		    $input['cover_image'] = $filename;
//            $input['slug'] = str_slug($input['title'],'-');
    		$destinationPath = 'images/tripPackages/cover';
    		$destinationPath1 = 'images/tripPackages/thumbnail';

    		if(!is_dir($destinationPath)){
    			mkdir(public_path($destinationPath), 0777, true);
		    }

            if(!is_dir($destinationPath1)){
			    mkdir(public_path($destinationPath1), 0777, true);
		    }


            Image::make($request->file('image'))->resize(1920,810)->save(public_path($destinationPath.'/'. $name ));
		    Image::make($request->file('image'))->resize(435,245)->save( public_path($destinationPath1.'/' . $name ));

            Cloudder::upload($image, null);
            list($width, $height) = getimagesize($image);
            $input['image_url']= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
            $input['image_url_thumb']= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);

    		$destinationPath = public_path('/images/tripPackages');

            $success = $request->image->move($destinationPath, $name);

            if(!$success){
    			if(file_exists($destinationPath.'/cover/'.$name)){
    				unlink($destinationPath.'/cover/'.$name);
			    }
			    return redirect()->back()->with('error', 'Sorry there was as error uploading cover image. Please try again.');
		    }
	    }

        TripPackages::create([
        	'title' => $request->title,
	        'description' => $request->description,
	        'image' => $name,
		    'rank' => $request->rank,
            'slug' => str_slug($request->title, '-'),
        ]);

        return redirect('/backend/tripPackages')->with('success', 'Trip Package Created Successfully.');

    }

    public function destroy(Request $request, $id){

        $result = PasswordChecker::checkpass($request->password);

        if($result == false){
	    	return redirect()->back()->with('error', 'The password you entered is incorrect.');
	    }

        $package = TripPackages::where('id', $id)->first();

        if(is_null($package)){
		    return redirect()->back()->with('error', 'The package you are trying to delete is either already deleted by admin or does not exist.');
	    }

        if($package->image != null){
	    	if(file_exists(public_path('/images/tripPackages/cover/'.$package->image))){
	    		unlink(public_path('/images/tripPackages/cover/'.$package->image));
		    }

            if(file_exists(public_path('/images/tripPackages/'.$package->image))){
	    		unlink(public_path('/images/tripPackages/'.$package->image));
		    }
	    }

        $package->trips()->detach();

        $package->delete();

        return redirect()->back()->with('success','Package deleted successfully.');
    }

    public function edit($id){
    	$package = TripPackages::where('id', $id)->first();

        if(is_null($package)){
		    return redirect()->back()->with('error', 'The package you are trying to edit is either deleted by admin or does not exist.');
	    }

        return view('admin-panel.tripPackages.create', compact('package'));
    }

    public function update(Request $request, $id){

//        dd($request->all());
    	$package = TripPackages::where('id', $id)->first();

        if(is_null($package)){
    	    return redirect('/backend/tripPackages')->with('error', 'The package you are trying to update is either deleted by admin or does not exist.');
	    }

        if($request->hasFile('image')){
//    		dd($request->name);
            $name = $request->image->getClientOriginalName();
//    		$name = time().rand(0,999).'.'.$request->image->extension();
            $destinationPath = 'images/tripPackages/cover';
            $destinationPath1 = 'images/tripPackages/thumbnail';

            $image_name = explode('.', $request->image->getClientOriginalName());
            $publicId = $image_name[0];

            Cloudder::upload($request->image, $publicId, array("width" => 1920, "height" => 810, "use_filename" => TRUE, "unique_filename" => FALSE,
                "format" => "jpg", "quality" => "auto", "folder" => "trippackages"));
            $package->image_url = Cloudder::getResult()['secure_url'];

            $publicId_thumb = $image_name[0];
            Cloudder::upload($request->image, $publicId_thumb, array("width" => 435, "height" => 245,
                "crop" => "scale", "folder" => "thumbnail", "quality" => "auto"));
            $package->image_url_thumb = Cloudder::getResult()['secure_url'];

//            dd($package->image_url, $package->image_url_thumb);

            if (!is_dir(public_path($destinationPath))) {
                mkdir(public_path($destinationPath), 0777, true);
		    }

            if(!is_dir($destinationPath1)){
			    mkdir(public_path($destinationPath1), 0777, true);
		    }

            Image::make($request->file('image'))->resize(1920,810)->save(public_path($destinationPath.'/'.$name ));
		    Image::make($request->file('image'))->resize(435,245)->save( public_path($destinationPath1.'/'.$name ));

            $package->image = $name;
	    }

        $package->title = $request->title;
    	$package->description = $request->description;
    	$package->rank = $request->rank;
        $package->slug = str_slug($request->title, '-');
    	$package->save();

        return redirect('/backend/tripPackages')->with('success', $package->title . ' Package has been updated successfully.');
    }

    public function addTrips($id){
        $package = TripPackages::where('id', $id)->first();

        //Only give trips to add that have not been added previously.

        $ids = [133];

        if(count($package->trips) > 0) {
		    foreach ($package->trips as $p) {
			    $ids[] = $p->id;
		    }

            $trips = Trips::whereNotIn('id', $ids)->get();
	    } else {
	    	$trips = Trips::all();
	    }

        return view('admin-panel.tripPackages.trips', compact('package', 'trips'));
    }

    public function attachTrips(Request $request, $id){

        if(!isset($request->toAdd)){
		    return redirect()->back()->with('error', 'Please select at least one trip to add.');
	    }

        $package = TripPackages::where('id', $id)->first();

        if(is_null($package)){
		    return redirect()->back()->with('error', 'The package you are trying to access is either deleted by admin or does not exist.');
	    }

        foreach($request->toAdd as $id) {
		    $package->trips()->attach($id);
	    }

        return redirect('/backend/tripPackages/addTrips/'.$package->id)->with('success', 'Trips Added Successfully.');

    }

    public function detachTrips(Request $request, $id){
	    if(!isset($request->toRemove)){
		    return redirect()->back()->with('error', 'Please select at least one trip to Remove.');
	    }

        $package = TripPackages::where('id', $id)->first();

        if(is_null($package)){
		    return redirect()->back()->with('error', 'The package you are trying to access is either deleted by admin or does not exist.');
	    }

        foreach($request->toRemove as $id) {
		    $package->trips()->detach($id);
	    }

        return redirect('/backend/tripPackages/addTrips/'.$package->id)->with('success', 'Trips Removed Successfully.');
    }
}
