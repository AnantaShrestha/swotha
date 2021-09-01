<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\Helper\PasswordChecker;
use App\Http\Requests\ThemesChangeImageRequest;
use App\Http\Requests\ThemesCreateRequest;
use App\Http\Requests\ThemesEditRequest;
use App\Themes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use JD\Cloudder\Facades\Cloudder;

//use Illuminate\Http\File;


class ThemeController extends Controller
{
    public function index(){
        $themes = Themes::all();
        return view('admin-panel.Themes.index',compact('themes'));
    }
    public function create(){
        $equipments = Equipment::all();
        return view('admin-panel.Themes.addTheme',compact('equipments'));
    }
    public function store(ThemesCreateRequest $request){
        $input = $request->all();
        $image = $input['image'];
        // return $image;
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['slug'] = str_slug($input['theme_name'],'-');
        $input['image'] = $filename;
        Image::make(Request::capture()->file('image'))->save( public_path('/images/themes/' . $filename ) );
        Image::make(Request::capture()->file('image'))->resize(1920,810)->save( public_path('/images/themes/cover/' . $filename ) );
        Image::make(Request::capture()->file('image'))->resize(435,245)->save( public_path('/images/themes/thumbnail/' . $filename ) );

        Cloudder::upload($image, null);
//        list($width, $height) = getimagesize($image);
        $input['image_url']= Cloudder::show(Cloudder::getPublicId(), ["width" => 1920, "height"=>810]);
        $input['image_url_thumb']= Cloudder::show(Cloudder::getPublicId(), ["width" => 435, "height"=>245]);

        $themes = Themes::create($input);
        $themes->equipments()->sync($request->input('equipments'));
        return redirect('/backend/themes');
    }

    public function edit($id){
        $themes = Themes::findOrFail($id);
        $equipments = Equipment::all();
        return view('admin-panel.Themes.editTheme',compact('themes','equipments'));
    }
    public function update(ThemesEditRequest $request, $id){
        $input = $request->all();
        $input['slug'] = str_slug($input['theme_name'],'-');
        $themes = Themes::findorFail($id);
        $themes->equipments()->sync($request->input('equipments'));
        $themes->update($input);
        return redirect('/backend/themes');
    }

    public function destroy(Request $request, $id){
    	$input = $request->all();
    	$result = PasswordChecker::checkpass($input['password']);
    	
    	if($result == true){
		    $theme = Themes::findOrFail($id);
//        if(File::exist(public_path('img/themes/'.$theme->image))){
		    File::delete(public_path('img/themes/'.$theme->image));
//        }
		    $theme->delete();
		    return redirect('/backend/themes')->with('success', 'Venture deleted successfully.');
	    } else {
		    return redirect('/backend/themes')->with('error', 'The password you entered is incorrect.');
	    }
     

    }

    public function changeImage(Request $request){
        $input = $request->all();
        $id = $input['id'];
        return view('admin-panel.Themes.changeImage',compact('id'));
    }
    public function ImageChange(ThemesChangeImageRequest $request){
        $input = $request->all();
        $image = $input['image'];
        $id = $input['id'];
        $themes = Themes::findorFail($id);
        File::delete(public_path('images/themes/'.$themes->image));
        File::delete(public_path('images/themes/cover/'.$themes->image));
        File::delete(public_path('images/themes/thumbnail/'.$themes->image));
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['image'] = $filename;
        Image::make(Request::capture()->file('image'))->save( public_path('/images/themes/' . $filename ) );
        Image::make(Request::capture()->file('image'))->resize(1920,810)->save( public_path('/images/themes/cover/' . $filename ) );
        Image::make(Request::capture()->file('image'))->resize(435,245)->save( public_path('/images/themes/thumbnail/' . $filename ) );

        Cloudder::upload($image, null);
//        list($width, $height) = getimagesize($image);
        $themes->image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => 1920, "height"=>810]);
        $themes->image_url_thumb= Cloudder::show(Cloudder::getPublicId(), ["width" => 435, "height"=>245]);

        $themes->image = $input['image'];
        $themes->save();
        return redirect('/backend/themes');

    }

}
