<?php

namespace App\Http\Controllers;

use App\ExtraPackage;
use App\Helper\PasswordChecker;
use App\Trips;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class ExtraPackagesController extends Controller
{
    public function index(){
    	$packages = ExtraPackage::all();
    	return view('admin-panel.extraPackages.index', compact('packages'));
    }
    
    public function create(){
    	return view('admin-panel.extraPackages.create');
    }
    
    public function store(Request $request){
        $input = $request->all();
	
	    if($request->hasFile('image')) {
		    $image = $request->file('image');
		    $name = time() . rand(0, 999) . '.'
			    . $request->image->getClientOriginalExtension();
		    $destinationPath = public_path('/images/trips/extraPackages');
		    $destinationPath1 = public_path('/images/trips/extraPackages/thumbnail');
		
		    if (!is_dir($destinationPath)) {
			    mkdir($destinationPath, 0777, true);
		    }
		
		    if (!is_dir($destinationPath1)) {
			    mkdir($destinationPath1, 0777, true);
		    }
		
		    Image::make(Request::capture()->file('image'))->resize(435,245)->save($destinationPath1.'/' . $name);
		    $request->image->move($destinationPath, $name);
	    }
		
	    $input['name'] = $name;
		
	    ExtraPackage::create([
	    	'title'=>$input['title'],
		    'description'=>$input['description'],
		    'price'=>$input['price'],
		    'image'=>$name,
	    ]);
	
	    return redirect('/backend/extrapackages')->with('success', 'Package added successfully');
    }
    
    public function edit($id){
    	$package = ExtraPackage::where('id', $id)->first();
    	
    	if(is_null($package)){
    		return redirect('/backend/extrapackages')->with('error', 'The package you are trying to edit is either deleted or doesn\'t exist.');
	    }
	    
	    return view('admin-panel.extraPackages.create')->with('package',$package);
    }
    
    public function update(Request $request, $id){
	    $package = ExtraPackage::where('id', $id)->first();
	
	    if(is_null($package)){
		    return redirect('/backend/extrapackages')->with('error', 'The package you are trying to edit is either deleted or doesn\'t exist.');
	    }
	    
	    $input = $request->all();
		
	    //Uploading new photo and deleting old one only if new is uploaded
	    if($request->hasFile('image')) {
		    $image = $request->file('image');
//		    dd($image);
		    $name = time() . rand(0, 999) . '.'
			    . $request->image->getClientOriginalExtension();
		    $destinationPath = public_path('/images/trips/extraPackages');
		    $destinationPath1 = public_path('/images/trips/extraPackages/thumbnail');
		
		    if (!is_dir($destinationPath)) {
			    mkdir($destinationPath, 0777, true);
		    }
		
		    if (!is_dir($destinationPath1)) {
			    mkdir($destinationPath1, 0777, true);
		    }
		
		    Image::make(Request::capture()->file('image'))->resize(435,245)->save($destinationPath1.'/' . $name);
		    $request->image->move($destinationPath, $name);
		    
		    //Deleting old image
		    
		    if($package->image != null){
//		    	dd($package->image);
			    if(file_exists(public_path('/images/trips/extraPackages/'.$package->image))){
				    unlink(public_path('/images/trips/extraPackages/'.$package->image));
			    }
			
			    if(file_exists(public_path('/images/trips/extraPackages/thumbnail/'.$package->image))){
				    unlink(public_path('/images/trips/extraPackages/thumbnail/'.$package->image));
			    }
		    }
		    
		    $package->image = $name;
	    }
	    
	    $package->title = $input['title'];
	    $package->description = $input['description'];
	    $package->price = $input['price'];
	    $package->save();
	    
	    return redirect('/backend/extrapackages')->with('success', 'Package updated succesfully.');
	    
    }
    
    public function destroy(Request $request, $id){
	    $input = $request->all();
	    $result = PasswordChecker::checkpass($input['password']);
	
	    if($result == true){
		    $package = ExtraPackage::where('id', $id)->first();
		
		    if(is_null($package)){
			    return redirect('/backend/extrapackages')->with('error', 'The package you are trying to delete doesn\'t exist.');
		    }
		    
		    //Deleted Related image
		    if($package->image != null){
			    if(file_exists(public_path('/images/trips/extraPackages/'.$package->image))){
				    unlink(public_path('/images/trips/extraPackages/'.$package->image));
			    }
			
			    if(file_exists(public_path('/images/trips/extraPackages/thumbnail/'.$package->image))){
				    unlink(public_path('/images/trips/extraPackages/thumbnail/'.$package->image));
			    }
		    }
		    
		    $package->delete();
		    return redirect('/backend/extrapackages')->with('success', 'Package Deleted Successfully.');
	    } else {
		    return redirect('/backend/extrapackages')->with('error', 'The password you entered is incorrect.');
	    }
    }
    
    public function addToTrip(Request $request, $id){
    	$input = $request->all();
    	
    	if(!isset($input['extraPackages'])){
    		return redirect()->back()->with('error', 'You forgot to select a extra package. Please select and try again.');
	    }
	    
	    $trip = Trips::find($id);
	    
	    for($i=0; $i<count($input['extraPackages']); $i++){
		    $trip->extraPackages()->attach($input['extraPackages'][$i]);
	    }
	    
	    return redirect()->back()->with('success', 'Extra Packages added successfully.');
    }
    
    public function deletePackageFromTrip(Request $request, $id){
	    $input = $request->all();
	
	    if(!isset($input['packages'])){
		    return redirect()->back()->with('error', 'You forgot to select a extra package to delete. Please select and try again.');
	    }
	    
	    $trip = Trips::find($id);
	    
	    for($i=0; $i<count($input['packages']); $i++){
	        $trip->extraPackages()->detach($input['packages'][$i]);
	    }
	    
	    return redirect()->back()->with('success', 'Selected Extra Packages are successfully detached from this trip.');
    }
}
