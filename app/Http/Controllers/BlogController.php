<?php

namespace App\Http\Controllers;

use App\Articles;
use App\ArticleSection;
use App\ArtImages;
use App\Category;
use App\Http\Requests\BlogsCreateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use JD\Cloudder\Facades\Cloudder;


class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('optimizeImages');
    }
    public function unindex(){
        $articles = Articles::all();
        $categories = Category::all();
        return view('admin-panel.blog.unpublished.unindex',compact('articles', 'categories'));
    }

    public function create(){
        $categories = Category::all();
        return view ('admin-panel.blog.create', compact('categories'));
    }

    public function store(BlogsCreateRequest $request){
        $input = $request->all();
//        dd($input);
        $image = $input['cover_image'];
        $input['is_published'] = 0;
        $filename = $request->cover_image->getClientOriginalName();
        $input['cover_image'] = $filename;
        $category = $input['categories'];
        $input['slug'] = str_slug($input['title'],'-');
//        dd($request->cover_image);
//	    Image::make(Request::capture()->file('cover_image'))->save( public_path('/images/blogs/' . $filename ) );
	    Image::make($image)->resize(435,245)->save( public_path('/images/blogs/thumbnail/' . $filename ) );

	    $destinationPath = public_path('/images/blogs/cover/');
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        $request->cover_image->move($destinationPath, $filename);

        /*$destinationPath1 = public_path('/images/blogs/');
        if (!is_dir($destinationPath1)) {
            mkdir($destinationPath1, 0777, true);
        }
        $request->cover_image->move($destinationPath1, $filename);*/

//        Image::make($image)->resize(1920,660)->save( public_path('/images/blogs/cover/' . $filename ) );

//        Cloudder::upload($image, null);
//        list($width, $height) = getimagesize($image);
//        $input['image_url']= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
//        $input['image_url_thumb']= Cloudder::show(Cloudder::getPublicId(), ["width" => 435, "height"=>245]);

        $articles = Articles::create($input);

        if($category) {
            $articles->categories()->attach($category);
        }
        return redirect('/backend/unblog');
    }

    public function publish(Request $request, $id){
        $blog = Articles::findorFail($id);
        $blog->update($request->all());
        return redirect()->back();
    }

    public function unpublish(Request $request, $id){
        $blog = Articles::findorFail($id);
        $blog->update($request->all());
        return redirect()->back();
    }

    public function show($id){
        $blog = Articles::findorFail($id);
	    $seo = $blog->seoblog;
	    return view('admin-panel.blog.showblog', compact('blog', 'seo'));
    }

    public function edit($id){
        $blog = Articles::findorFail($id);
        $categories = Category::all();
        return view('admin-panel.blog.editblog', compact('blog','categories'));
    }

    public function update(Request $request, $id){
        $input = $request->all();
        $input['slug'] = str_slug($input['title'], '-');
        $article = Articles::findOrFail($id);
        $category = $input['categories'];

        if($request->hasFile('cover_image')){
	        File::delete(public_path('images/blogs/'.$article->cover_image));
	        File::delete(public_path('images/blogs/thumbnail/'.$article->cover_image));
	        File::delete(public_path('images/blogs/cover/'.$article->cover_image));
	        $image = $input['cover_image'];
	        $filename = time() . '.' . $image->getClientOriginalExtension();
	        $input['cover_image'] = $filename;
	        Image::make(Request::capture()->file('cover_image'))->save( public_path('/images/blogs/' . $filename ) );
	        Image::make($image)->resize(1920,660)->save( public_path('/images/blogs/cover/' . $filename ) );
	        Image::make($image)->resize(435,245)->save( public_path('/images/blogs/thumbnail/' . $filename ) );

            Cloudder::upload($image, null);
            list($width, $height) = getimagesize($image);
            $input['image_url']= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
            $input['image_url_thumb']= Cloudder::show(Cloudder::getPublicId(), ["width" => 435, "height"=>245]);

        }else{
	        $input['cover_image'] = $article->cover_image;
        }
        $article->update($input);
        $article->categories()->sync($category);
        return redirect('/backend/unblog');
    }
    public function destroy($id){
        $blog = Articles::findOrFail($id);

        foreach($blog->sections as $section){
        	foreach($section->images as $image){
        		File::delete(public_path('images/blogs/'.$image->image));
        		$image->delete();
	        }

            $section->delete();
	    }

        $images = Articles::find($id)->images;

        foreach ($images as $image){
            File::delete(public_path('images/blogs/images/'.$image->image));
        }

        File::delete(public_path('images/blogs/'.$blog->cover_image));
        File::delete(public_path('images/blogs/thumbnail/'.$blog->cover_image));
        File::delete(public_path('images/blogs/cover/'.$blog->cover_image));

        $blog->categories()->detach();
	    $blog->delete();
	    return redirect()->back();
    }

    public function mulimages($id){
        return view('admin-panel.blog.addmulimages', compact('id'));
    }

    public function storemulimages(Request $request){
        $input = $request->all();
        if ($request->hasFile('image')) {
            $files = $request->file('image');

            foreach($files as $file){
                $input['article_id'] =  $request->get('article_id');
                $input['image'] = null;
                $random_name = str_random(8);
                $destinationPath = public_path('/images/blogs/images/');
                $extension = $file->getClientOriginalExtension();
                $input['image'] = $filename = $random_name.'_img.'.$extension;
                $file->move($destinationPath, $filename);
                ArtImages::create($input);
            }
        }
        return $this->show($request->get('article_id'));
    }

    public function destroyimage($id){
        $blog = ArtImages::findOrFail($id);
        File::delete(public_path('images/blogs/images/'.$blog->image));
        $blog->delete();
        return redirect()->back();
    }

    public function addPhoto(Request $request, $id){
    	$input = $request->all();

        $blog = Articles::where('id', $id)->first();

        $oldImage = $input['oldImage'];

        if($oldImage != ''){
	        File::delete(public_path('images/blogs/profile/'.$oldImage));
	    }

        $image = $input['profile'];
	    $filename = time() . '.' . $image->getClientOriginalExtension();
	    Image::make(Request::capture()->file('profile'))->save( public_path('/images/blogs/profile/' . $filename ) );
	    $blog->profile = $filename;
	    $blog->save();

        return redirect()->back()->with('success', 'Author Picture Updated successfully.');
    }

    public function addSection($id){
    	return view('admin-panel.blog.addSection', compact('id'));
    }

    public function storeSection(Request $request, $id){
    	$section = new ArticleSection();
        $section->article_id = $id;
        $section->description = $request->description;
        $section->save();

        for($i=0; $i<count($request->image); $i++){
    		$name = rand(0,999).$request->image[$i]->getClientOriginalName();
            $request->image[$i]->move(public_path('images/blogs'), $name);
			$artimage = new ArtImages();
			$artimage->section_id = $section->id;
			$artimage->image = $name;

            if(isset($request->caption[$i]) && ($request->caption[$i] != null)){
				$artimage->caption = $request->caption[$i];
			}

            $artimage->save();
        }

        return redirect('/backend/blog/'.$id.'/show')->with('success', 'Section added successfully.');
    }

    public function editSection($id){
    	$section = ArticleSection::find($id);

        return view('admin-panel.blog.addSection', compact('section'));
    }

    public function updateSection(Request $request, $id){
    	$section = ArticleSection::find($id);

        $section->description = $request->description;
    	$section->save();

        for($i=0; $i<count($request->oldImage); $i++){
    		$id = $request->oldImage[$i];
    		$artimage = ArtImages::find($id);
    		$artimage->caption = $request->oldCaption[$i];
    		$artimage->save();
	    }

        if(isset($request->delete)){
    		foreach($request->delete as $delId){
    			$image = ArtImages::find($delId);

                if(file_exists(public_path('images/blogs/'.$image->image))){
    				unlink(public_path('images/blogs/'.$image->image));
			    }

                $image->delete();
		    }
	    }

        if(isset($request->image)){
		    for($i=0; $i<count($request->image); $i++){
			    $name = rand(0,999).$request->image[$i]->getClientOriginalName();
			    $request->image[$i]->move(public_path('images/blogs'), $name);
			    $artimage = new ArtImages();
			    $artimage->section_id = $id;
			    $artimage->image = $name;

                if(isset($request->caption[$i]) && ($request->caption[$i] != null)){
				    $artimage->caption = $request->caption[$i];
			    }

                $artimage->save();
		    }
	    }

        return redirect('/backend/blog/'.$section->article_id.'/show');
    }

    public function deleteSection($id){
    	$section = ArticleSection::find($id);

        foreach($section->images as $image){
    		File::delete(public_path('images/blogs/'.$image->image));
    		$image->delete();
	    }

        $section->delete();

        return redirect()->back()->with('success', 'Section deleted successfully.');
    }
}
