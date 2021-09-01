<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\Helper\PasswordChecker;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class EquipmentsController extends Controller
{
    public function index(){
        $equipments = Equipment::all();
        return view('admin-panel.Equipment.index',compact('equipments'));
    }
    public function create(){
        return view('admin-panel.Equipment.add');
    }
    public function store(Request $request){
    	
    	$input = $request->all();
    	
	    if($request->hasFile('image')) {
		    $name =time() . '.'
			    . $request->image->getClientOriginalExtension();
		    $destinationPath = public_path('/images/equipments');
		    $destinationPath1 = public_path('/images/equipments/thumbnail');
		
		    if (!is_dir($destinationPath)) {
			    mkdir($destinationPath, 0777, true);
		    }
		
		    if (!is_dir($destinationPath1)) {
			    mkdir($destinationPath1, 0777, true);
		    }
		
		    Image::make(Request::capture()->file('image'))->resize(435,245)->save($destinationPath1.'/' . $name);
		    $request->image->move($destinationPath, $name);
	    }
	    
		$input['image'] = $name;
	    Equipment::create($input);
	    
        return redirect('/backend/equipments');
    }
    public function edit($id){
        $equipment = Equipment::find($id);
        return view('admin-panel.Equipment.edit',compact('equipment'));

    }
    public function update($id, Request $request){
        $equipment = Equipment::findOrFail($id);
        $input = $request->all();
        
	    if($request->hasFile('image')) {
		    $name =time() . '.'
			    . $request->image->getClientOriginalExtension();
		    $destinationPath = public_path('/images/equipments');
		    $destinationPath1 = public_path('/images/equipments/thumbnail');
		
		    if (!is_dir($destinationPath)) {
			    mkdir($destinationPath, 0777, true);
		    }
		
		    if (!is_dir($destinationPath1)) {
			    mkdir($destinationPath1, 0777, true);
		    }
		
		    Image::make(Request::capture()->file('image'))->resize(435,245)->save($destinationPath1.'/' . $name);
		    $request->image->move($destinationPath, $name);
		    $input['image'] = $name;
		
		    if($equipment->image != null){
//		    	dd($package->image);
			    if(file_exists(public_path('/images/equipments/'.$equipment->image))){
				    unlink(public_path('/images/equipments/'.$equipment->image));
			    }
			
			    if(file_exists(public_path('/images/equipments/thumbnail/'.$equipment->image))){
				    unlink(public_path('/images/equipments/thumbnail/'.$equipment->image));
			    }
		    }
		    
	    }else{
	    	$input['image'] = $equipment->image;
	    }
	    
        $equipment->update($input);
        return redirect('/backend/equipments');
    }
    public function destroy(Request $request, $id){
    	$input = $request->all();
    	$result = PasswordChecker::checkpass($input['password']);
    	
        if($result == true) {
	        $equipment = Equipment::findOrFail($id);
	        $equipment->delete();
	        return redirect('/backend/equipments')->with('success', 'Equipment Deleted Successfully.');
        }else{
	        return redirect('/backend/equipments')->with('error', 'The password you entered is incorrect.');
        }
    }
}
