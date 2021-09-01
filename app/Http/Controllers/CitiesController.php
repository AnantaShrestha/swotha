<?php

namespace App\Http\Controllers;

use App\Cities;
use App\Helper\PasswordChecker;
use App\Http\Requests\CitiesChangeImageRequest;
use App\Http\Requests\CitiesCreateRequest;
use App\Http\Requests\CitiesEditRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class CitiesController extends Controller
{
    public function index(){
        $cities = Cities::with('destinations')->paginate(6);
        return view('admin-panel.Cities.index',compact('cities'));

    }
    public function create(){
        $d_id = Input::get('destination_id');
        return view('admin-panel.Cities.createCities',compact('d_id'));
    }
    public function show($id){
        $cities = Cities::findOrFail($id);
        return view('admin-panel.Cities.showCities',compact('cities'));
    }
    public function store(CitiesCreateRequest $request){
        $input = $request->all();
        $image = $input['cover_image'];
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['cover_image'] = $filename;
        $input['slug'] = str_slug($input['title'],'-');

        $destinationPath = public_path('/images/cities/');
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        $request->image->move($destinationPath, $filename);

        $destinationPath1 = public_path('/images/cities/cover/');
        if (!is_dir($destinationPath1)) {
            mkdir($destinationPath1, 0777, true);
        }
        $request->image->move($destinationPath1, $filename);
//        Image::make(Request::capture()->file('cover_image'))->save( public_path('/images/cities/' . $filename ) );
//        Image::make($image)->resize(1920,660)->save( public_path('/images/cities/cover/' . $filename ) );
        Image::make($image)->resize(435,245)->save( public_path('/images/cities/thumbnail/' . $filename ) );
        Cities::create($input);
        return redirect('/backend/cities');

    }
    public function edit($id){
        $cities = Cities::findOrFail($id);
        return view('admin-panel.Cities.editCities',compact('cities'));
    }
    public function update(CitiesEditRequest $request, $id){
        $input = $request->all();
        $cities = Cities::findorFail($id);
        $input['slug'] = str_slug($input['title'],'-');
        // dd($request->all());
        $cities->update($input);
        return redirect('/backend/cities');
    }
    public function destroy(Request $request, $id){
    	$input = $request->all();
    	$result = PasswordChecker::checkpass($input['password']);
    	
    	if($result == true){
		    $cities = Cities::findOrFail($id);
		    File::delete(public_path('images/cities/'.$cities->cover_image));
		    $cities->delete();
		
		    return redirect('/backend/cities')->with('success', 'Region Deleted Successfully.');
	    } else {
		    return redirect('/backend/cities')->with('error', 'The password you entered is incorrect.');
	    }
     
    }

    public function changeImage(Request $request){
        $input = $request->all();
        $id = $input['id'];
        return view('admin-panel.Cities.changeImage',compact('id'));
    }
    public function imageChange(CitiesChangeImageRequest $request){
        $input = $request->all();
        $image = $input['cover_image'];
        $id = $input['id'];
        $cities = Cities::findorFail($id);
        File::delete(public_path('images/cities/'.$cities->cover_image));
        File::delete(public_path('images/cities/thumbnail/'.$cities->cover_image));
        File::delete(public_path('images/cities/cover/'.$cities->cover_image));
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['cover_image'] = $filename;

        $destinationPath = public_path('/images/cities/');
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        $request->image->move($destinationPath, $filename);

        $destinationPath1 = public_path('/images/cities/cover/');
        if (!is_dir($destinationPath1)) {
            mkdir($destinationPath1, 0777, true);
        }
        $request->image->move($destinationPath1, $filename);

//        Image::make(Request::capture()->file('cover_image'))->save( public_path('/images/cities/' . $filename ) );
//        Image::make($image)->resize(1920,660)->save( public_path('/images/cities/cover/' . $filename ) );
        Image::make($image)->resize(435,245)->save( public_path('/images/cities/thumbnail/' . $filename ) );
        $cities->cover_image = $input['cover_image'];
        $cities->save();
        return redirect('/backend/cities');

    }
}
