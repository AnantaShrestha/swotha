<?php

namespace App\Http\Controllers;

use App\CoverImage;
use App\Helper\PasswordChecker;
use App\Http\Requests\CoverTitleEdit;
use App\Http\Requests\CreateCoverImageRequest;
use App\Http\Requests\EditCoverImageRequest;
use App\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use JD\Cloudder\Facades\Cloudder;

class BackEndIndexCoverController extends Controller
{
    public function __construct()
    {
        $this->middleware('optimizeImages');
    }

    public function index(){
        $coverImages = CoverImage::where('is_parallax', 0)->get();
        $parallax = CoverImage::where('is_parallax','!=', 0)->get();
        /*$search = Search::first();*/
        return view('admin-panel.CoverImageIndex.index',compact('coverImages', 'parallax', 'search'));
    }
    public function create(){
        return view('admin-panel.CoverImageIndex.createNew');
    }
    public function addvideo(){
        return view('admin-panel.CoverImageIndex.createNewVideo');
    }
    public function storevideo(Request $request){
            $input = $request->all();
            $image = $input['image'];
            if($image->getClientOriginalExtension() == 'mp4'){
                $filename = $image->getClientOriginalName();
                $path = public_path().'/images/coverImage';
                $image->move($path, $filename);
                $input['image'] = $filename;
                $video = new CoverImage();
                $video->title = $input['title'];
                $video->image = $input['image'];
                $video->is_video = 1;
                $video->save();
                return ('I have moved');
            }
    }

    public function store(CreateCoverImageRequest $request){
        $input = $request->all();
//        return "I am here";
        $image = $input['image'];
        $filename = 'cover_image'.time(). '.' . $image->getClientOriginalExtension();
        $input['image'] = $filename;
        if($image->getClientOriginalExtension() == 'gif'){
            copy(Request::capture()->file('image')->getRealPath(),public_path('/images/coverImage/' . $filename ));
//            return "I am here";
        }else{
	        $image_name= explode('.',$image->getClientOriginalName());
	        $publicId = $image_name[0];
	        Cloudder::upload($image, $publicId, array("use_filename" => TRUE, "unique_filename"=>FALSE,"format"=>"jpg","folder"=>"cover_image",
		        "width" => 1366, "height" => 768,"quality"=>"auto"));
            $input['image_url'] = Cloudder::getResult()['secure_url'];
//
            Image::make($image)->save( public_path('/images/coverImage/' . $filename ) );

        }
        CoverImage::create($input);
        return redirect('/backend/indexcoverimage');
    }
    public function edit($id){
        $CoverImage = CoverImage::findOrFail($id);
        return view('admin-panel.CoverImageIndex.edit',compact('CoverImage'));
    }
    public function update(CoverTitleEdit $request, $id){
        $destinations = CoverImage::findorFail($id);
        $destinations->update($request->all());
        return redirect('/backend/indexcoverimage');
    }
    public function destroy(Request $request, $id){
    	$input = $request->all();
    	$result = PasswordChecker::checkpass($input['password']);

        if($result == true){
		    $destinations = CoverImage::findOrFail($id);
//        return $destinations;
		    //$file = url('img/trips/'.$trip->cover_image);
		    File::delete(public_path('images/coverImage/'.$destinations->image));
		    $destinations->delete();

            return redirect('/backend/indexcoverimage')->with('success', 'Cover Image deleted successfully.
		     Please note that having 0 image on cover image causes error on front-end.');
	    } else {
		    return redirect('/backend/indexcoverimage')->with('error', 'The password you entered is incorrect.');
	    }

    }
    public function changeImage(Request $request){
            $input = $request->all();
            $id = $input['id'];
            return view('admin-panel.CoverImageIndex.changeImage',compact('id'));
    }
    public function imageChange(EditCoverImageRequest $request){
        $input = $request->all();
//        dd($input);
        $image = $input['image'];
        $id = $input['id'];
        $destinations = CoverImage::findorFail($id);
        File::delete(public_path('images/coverImage/'.$destinations->image));
        $filename = $image->getClientOriginalName();
        $input['image'] = $filename;
//        return  $image->getClientOriginalExtension();
        if( $image->getClientOriginalExtension() == 'gif'){
            copy(Request::capture()->file('image')->getRealPath(),public_path('/images/coverImage/' . $filename ));
        }else{
            $image_name= explode('.',$image->getClientOriginalName());
            $publicId = $image_name[0];
            Cloudder::upload($image, $publicId, array("use_filename" => TRUE, "unique_filename"=>FALSE,"format"=>"jpg","folder"=>"cover_image",
	            "width" => 1920, "height" => 930,"quality"=>"auto"));
            $destinations->image_url= Cloudder::getResult()['url'];
//            $destinations->image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width]);
            //save to uploads directory
            $destinationPath = public_path('/images/coverImage/');
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $request->image->move($destinationPath, $filename);

        }
//        Image::make(Request::capture()->file('image'))->save( public_path('/img/coverImage/' . $filename ) );
        $destinations->image = $input['image'];
        $destinations->save();
        return redirect('/backend/indexcoverimage');

    }

    public function addParallax(){
    	return view('admin-panel.CoverImageIndex.addParallax');
    }

    public function storeParallax(Request $request){
    	$input = $request->all();
	    $image = $input['image'];
	    $filename = time() . '.' . $image->getClientOriginalExtension();
	    $input['image'] = $filename;

        Image::make($image)->resize(1920,930)->save( public_path('/images/coverImage/' . $filename ) );

        $parallax = new CoverImage();
	    $parallax->image = $filename;
	    $parallax->is_parallax = $input['position'];
	    $parallax->title = $request->title;
	    $parallax->description = $request->description;
	    $parallax->save();

        return redirect('/backend/indexcoverimage');
    }

    public function deleteParallax(Request $request, $id){
	    $input = $request->all();
	    $result = PasswordChecker::checkpass($input['password']);

        if($result == true){
		    $destinations = CoverImage::where([['id', $id], ['is_parallax', '!=', 0]])->first();
//        return $destinations;
		    //$file = url('img/trips/'.$trip->cover_image);
		    File::delete(public_path('images/coverImage/'.$destinations->image));
		    $destinations->delete();

            return redirect('/backend/indexcoverimage')->with('success', 'Parallax Image deleted successfully.
		     Please note that having 0 image on cover image causes error on front-end.');
	    } else {
		    return redirect('/backend/indexcoverimage')->with('error', 'The password you entered is incorrect.');
	    }
    }

    /*public function updateSearch(Request $request){
    	$input = $request->all();

    	$search = Search::where('id', $input['id'])->first();
    	if(is_null($search)){
    		$search = new Search();
	    }

    	$search->title = $input['title'];
    	$search->save();

    	return redirect()->back()->with('success', 'Search placeholder updated successfully.');
    }*/

    public function editParallax($id){
    	$parallax = CoverImage::where('id', $id)->first();

        return view('admin-panel.CoverImageIndex.addParallax', compact('parallax'));
    }

    public function updateParallax(Request $request, $id){
	    $parallax = CoverImage::where('id', $id)->first();

	    $input = $request->all();

	    if(is_null($parallax)){
		    return redirect('/backend/tripPackages')->with('error', 'The package you are trying to update is either deleted by admin or does not exist.');
	    }

        if($request->hasFile('image')){
	        $image = $input['image'];
	        $name = time().rand(0,999).'.'.$request->image->extension();
		    $destinationPath = 'images/coverImage';

            if(!is_dir(public_path($destinationPath))){
			    mkdir(public_path($destinationPath), 077, true);
		    }

            $image_name= explode('.',$image->getClientOriginalName());
		    $publicId = $image_name[0];

            Cloudder::upload($image, $publicId, array("use_filename" => TRUE, "unique_filename"=>FALSE,"format"=>"jpg","folder"=>"cover_image",
			    "width" => 1920, "height" => 930,"quality"=>"auto"));
		    $parallax->image_url= Cloudder::getResult()['url'];

            $request->image->move(public_path($destinationPath), $name);

            if(file_exists(public_path('/images/coverImage/'.$parallax->image))){
			    unlink(public_path('/images/coverImage/'.$parallax->image));
		    }

            $parallax->image = $name;

//            Cloudder::upload($image, null);
//            list($width, $height) = getimagesize($image);
//            $input['image_url']= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
	    }

        $parallax->is_parallax = $request->position;
	    $parallax->title = $request->title;
	    $parallax->description = $request->description;
	    $parallax->save();

        return redirect('/backend/indexcoverimage')->with('success',$parallax->name.' parallax has been updated successfully.');
    }
}
