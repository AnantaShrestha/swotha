<?php

namespace App\Http\Controllers;

use App\Destinations;
use App\Helper\PasswordChecker;
use App\Http\Requests\DestinationChangeImageRequest;
use App\Http\Requests\DestinationCreateRequest;
use App\Http\Requests\DestinationEditRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use JD\Cloudder\Facades\Cloudder;

//use Illuminate\Http\File;


class DestinationsController extends Controller
{
    public function index(){
        $destinations = DB::table('destinations')->paginate(15);
        return view('admin-panel.Destinations.index',compact('destinations'));
    }

    public function create(){
        return view('admin-panel.Destinations.createDestination');
    }

    public function store(DestinationCreateRequest $request){
        $input = $request->all();
        $image = $input['image'];
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['image'] = $filename;
        $slug =  str_slug($input['country_name'], '-');
        $input['slug'] = $slug;
        $destinationPath = public_path('/images/destinations/');
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        $request->image->move($destinationPath, $filename);

        $destinationPath1 = public_path('/images/destinations/cover/');
        if (!is_dir($destinationPath1)) {
            mkdir($destinationPath1, 0777, true);
        }
        $request->image->move($destinationPath1, $filename);
//        Image::make(Request::capture()->file('image'))->save( public_path('/images/destinations/' . $filename ) );
//        Image::make($image)->resize(1920,810)->save( public_path('/images/destinations/cover/' . $filename ) );
        Image::make($image)->resize(435, 245)->save( public_path('/images/destinations/thumbnail/' . $filename ) );

        Cloudder::upload($image, null);
        list($width, $height) = getimagesize($image);
        $input['image_url']= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
        $input['image_url_thumb']= Cloudder::show(Cloudder::getPublicId(), ["width" => 435, "height"=>245]);

        Destinations::create($input);
        return redirect('/backend/destinations');
    }

    public function edit($id){
        $destination = Destinations::findOrFail($id);
        return view('admin-panel.Destinations.editDestination',compact('destination'));
    }
    public function update(DestinationEditRequest $request, $id){
        $input = $request->all();
        $destinations = Destinations::findorFail($id);
        $slug =  str_slug($input['country_name'], '-');
        $input['slug'] = $slug;
        $destinations->update($input);
        return redirect('/backend/destinations');
    }
    public function destroy(Request $request, $id){
    	$input = $request->all();
    	$result = PasswordChecker::checkpass($input['password']);
    	
    	if($result == true){
		    $destinations = Destinations::findOrFail($id);
		    //$file = url('img/trips/'.$trip->cover_image);
		    File::delete(public_path('images/destinations/'.$destinations->image));
		    File::delete(public_path('images/destinations/thumbnail/'.$destinations->image));
		    File::delete(public_path('images/destinations/cover/'.$destinations->image));
		    $destinations->delete();
		    return redirect('/backend/destinations')->with('success', 'Country Deleted Successfully.');
	    } else {
    	    return redirect('/backend/destinations')->with('error', 'The password you entered is incorrect.');
	    }
        

    }
    public function show(Destinations $destination){

        /*foreach ($destination->cities as $ss){
//    		dd($destination->cities);
            foreach ($ss->trips as $s){
                foreach ($s->date as $item){
                    dd($item->start_date);
                }
            }
        }*/
	    
        return view('admin-panel.Destinations.showDestination',compact('destination'));
    }
    public function changeImage(Request $request){
        $input = $request->all();
        $id = $input['id'];
//        return $id;
        return view('admin-panel.Destinations.changeImage',compact('id'));
//        return "I am here";
    }
    public function imageChange(DestinationChangeImageRequest $request){
        $input = $request->all();
        $image = $input['image'];
        $id = $input['id'];
        $destinations = Destinations::findorFail($id);
        File::delete(public_path('images/destinations/'.$destinations->image));
        File::delete(public_path('images/destinations/thumbnail/'.$destinations->image));
        File::delete(public_path('images/destinations/cover/'.$destinations->image));
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['image'] = $filename;

        Cloudder::upload($image, null);
        list($width, $height) = getimagesize($image);
        $destinations->image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
        $destinations->image_url_thumb= Cloudder::show(Cloudder::getPublicId(), ["width" => 435, "height"=>245]);

        /*$destinationPath = public_path('/images/destinations/');
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        $request->image->move($destinationPath, $filename);

        $destinationPath1 = public_path('/images/destinations/cover/');
        if (!is_dir($destinationPath1)) {
            mkdir($destinationPath1, 0777, true);
        }

        $request->image->move($destinationPath1, $filename);*/


        Image::make(Request::capture()->file('image'))->save( public_path('/images/destinations/' . $filename ) );
        Image::make($image)->resize(1920,810)->save( public_path('/images/destinations/cover/' . $filename ) );
        Image::make($image)->resize(435, 245)->save( public_path('/images/destinations/thumbnail/' . $filename ) );;
        $destinations->image = $input['image'];
        $destinations->save();
        return redirect('/backend/destinations');

    }
}
