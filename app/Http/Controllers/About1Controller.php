<?php

namespace App\Http\Controllers;

use App\About;
use App\AboutDetails;
use App\AboutImages;
use App\Helper\PasswordChecker;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;
use JD\Cloudder\Facades\Cloudder;


class About1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function __construct()
    {
        $this->middleware('optimizeImages');
    }

    public function index()
    {
        $abouts = About::all();
        return view('admin-panel.about1.index', compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin-panel.about1.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $image = $input['cover_image'];
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['cover_image'] = $filename;
        $input['slug'] = str_slug($input['aboutname'],'-');
//        $destinationPath = public_path('/images/about/');
//        if (!is_dir($destinationPath)) {
//            mkdir($destinationPath, 0777, true);
//        }
//        $request->file('cover_image')->move($destinationPath, $filename);

//        $destinationPath1 = public_path('/images/about/cover/');
//        if (!is_dir($destinationPath1)) {
//            mkdir($destinationPath1, 0777, true);
//        }
//        $request->file('cover_image')->move($destinationPath1, $filename);
//        copy($destinationPath.$filename, $destinationPath1.$filename);
//        Image::make(Request::capture()->file('cover_image'))->save( public_path('/images/about/' . $filename ) );
        Image::make($image)->resize(1920, 910)->save(public_path('/images/about/cover/' . $filename));
        Image::make($image)->resize(435,245)->save( public_path('/images/about/thumbnail/'. $filename ) );

        Cloudder::upload($image, null);
//        list($width, $height) = getimagesize($image);
        $input['image_url']= Cloudder::show(Cloudder::getPublicId(), ["width" => 1920, "height"=>810]);
        $input['image_url_thumb']= Cloudder::show(Cloudder::getPublicId(), ["width" => 435, "height"=>245]);

        About::create($input);

        return redirect('/backend/about');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $about = About::findOrFail($id);
        return view('admin-panel.about1.show', compact('about'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $about = About::findOrFail($id);
        return view('admin-panel.about1.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $about = About::findOrFail($id);
        $input = $request->all();
        if($request->hasFile('cover_image')){
        	$image = $request['cover_image'];

	        $filename = time() . '.' . $image->getClientOriginalExtension();
	        $input['cover_image'] = $filename;

           /* $destinationPath = public_path('/images/about/');
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $request->image->move($destinationPath, $filename);*/

            /*$destinationPath1 = public_path('/images/about/cover/');
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath1, 0777, true);
            }*/

//	        Image::make(Request::capture()->file('cover_image'))->save( public_path('/images/about/' . $filename ) );
	        Image::make($image)->resize(1920,910)->save( public_path('/images/about/cover/' . $filename ) );
	        Image::make($image)->resize(435,245)->save( public_path('/images/about/thumbnail/' . $filename ) );
	        File::delete(public_path('images/about/thumbnail/'.$about->cover_image));
	        File::delete(public_path('images/about/cover/'.$about->cover_image));

//            Cloudder::upload($image, null);
//        list($width, $height) = getimagesize($image);
//            $input['image_url']= Cloudder::show(Cloudder::getPublicId(), ["width" => 1920, "height"=>810]);
//            $input['image_url_thumb']= Cloudder::show(Cloudder::getPublicId(), ["width" => 435, "height"=>245]);


        }else{
	        $input['cover_image'] = $about->cover_image;
        }
	    $input['slug'] = str_slug($input['aboutname'],'-');
        $about->update($input);
        return redirect('/backend/about');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
    	$input = $request->all();
    	$result = PasswordChecker::checkpass($input['password']);

    	if($result == true){
		    $about = About::findOrFail($id);
		    File::delete(public_path('images/about/cover/'.$about->cover_image));
		    File::delete(public_path('images/about/thumbnail/'.$about->cover_image));
		    File::delete(public_path('images/about/'.$about->cover_image));
		    $about->delete();
		    return redirect()->back()->with('success', 'Page Deleted Successfully.');
	    } else {
		    return redirect()->back()->with('error', 'The password you entered is incorrect.');
	    }

    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function addSection($id){
        return view('admin-panel.about1.addSection', compact('id'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function createSection(Request $request, $id){
    	$input = $request->all();

    	$aboutDetails = new AboutDetails();

    	$aboutDetails->about_id = $id;
    	$aboutDetails->description = $input['content'];
    	$aboutDetails->title = $input['title'];

    	if(isset($request->coverImage)) {
		    //Inserting cover picture
		    $ext = $request->coverImage->getClientOriginalExtension();
		    $filename = 'file-' . rand(0, 999) . '.' . $ext;

            $destinationPath = public_path('/images/about');

            if (!is_dir($destinationPath)) {
			    mkdir($destinationPath, 0777, true);
		    }

            $success = $request->coverImage->move($destinationPath, $filename);

            if ($success) {
			    $aboutDetails->cover_image = $filename;
		    }
	    }

        $aboutDetails->save();

        if(isset($request->images)) {
		    foreach ($request->images as $image) {
			    $ext = $image->getClientOriginalExtension();
			    $filename = 'file-' . rand(0, 999) . '.' . $ext;

                $destinationPath = public_path('/images/about');

                if (!is_dir($destinationPath)) {
				    mkdir($destinationPath, 0777, true);
			    }

                $success = $image->move($destinationPath, $filename);

                if ($success) {
				    $aboutImage = new AboutImages();
				    $aboutImage->about_details_id = $aboutDetails->id;
				    $aboutImage->image = $filename;
				    $aboutImage->save();
			    }

            }
	    }

        return redirect('/backend/about/'.$id)->with('success', 'Section Added Successfully.');
    }

    /**
     * @param $id
     * @return Factory|RedirectResponse|View
     */
    public function editSection($id){
    	$section = AboutDetails::where('id', $id)->first();

        if(count($section) == 0){
    	    return redirect()->back()->with('error', 'The section you are trying to edit is either deleted or does not exist.');
	    }

        return view('admin-panel.about1.editSection', compact('section'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function saveSection(Request $request, $id){
    	$section = AboutDetails::where('id', $id)->first();

        if(is_null($section)){
    		return redirect()->back()->with('error', 'The section you are trying to edit is either deleted or does not exist.');
	    }

        $input = $request->all();

        //Deleting checked images
    	if(isset($input['delete']) && count($input['delete']) > 0){
    		foreach($input['delete'] as $value){
    			$image = AboutImages::where('id', $value)->first();
    			$name = $image->image;

                if(file_exists(public_path('/images/about/'.$name))){
				    unlink(public_path('/images/about/'.$name));
			    }

                $image->delete();
		    }
	    }


        //Inserting new images
	    if(isset($input['images'])) {
		    foreach ($request->images as $image) {
			    $ext = $image->getClientOriginalExtension();
			    $filename = 'file-' . rand(0, 999) . '.' . $ext;

                $destinationPath = public_path('/images/about');

                if (!is_dir($destinationPath)) {
				    mkdir($destinationPath, 0777, true);
			    }

                $success = $image->move($destinationPath, $filename);

                if ($success) {
				    $aboutImage = new AboutImages();
				    $aboutImage->about_details_id = $id;
				    $aboutImage->image = $filename;
				    $aboutImage->save();
			    }

            }
	    }

        //Updating the section or about_details
	    if(isset($input['coverImage'])) {
		    $oldCover = $section->cover_image;

            if (file_exists(public_path('/images/about/' . $oldCover))) {
			    unlink(public_path('/images/about/' . $oldCover));
		    }

            $ext = $request->coverImage->getClientOriginalExtension();
		    $filename = 'file-' . rand(0, 999) . '.' . $ext;

            $destinationPath = public_path('/images/about');

            if (!is_dir($destinationPath)) {
			    mkdir($destinationPath, 0777, true);
		    }

            $success = $request->coverImage->move($destinationPath, $filename);

            if ($success) {
			    $section->cover_image = $filename;
		    }
	    }

        $section->description = $input['content'];
    	$section->title = $input['title'];
    	$section->save();

        return redirect('/backend/about/'.$section->about_id)->with('success', 'Section updated successfully.');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function deleteSections(Request $request){
    	$input = $request->all();

        if(!isset($input['delete'])){
    		return redirect()->back()->with('error', 'Please select the section you want to delete.');
	    }

        foreach($input['delete'] as $value){
    		$section = AboutDetails::where('id', $value)->first();

            $section->delete();
	    }

        return redirect()->back()->with('success', 'Section deleted successfully.');
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function seosectionshow($id){
        $seodetails = About::findOrFail($id);
        return view('admin-panel.about1.seosection', compact('seodetails'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function seosectionchange(Request $request){
        $input = $request->all();
        $id = $input['id'];

        $seoDetails = About::where('id', $id)->first();

        $seoDetails->meta_keywords = $input['meta_keywords'];
        $seoDetails->meta_title = $input['meta_title'];
        $seoDetails->meta_description = $input['meta_description'];

        $seoDetails->save();

        return redirect('backend/about');
    }
}
