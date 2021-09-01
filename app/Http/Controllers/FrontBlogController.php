<?php

namespace App\Http\Controllers;

use App\Articles;
use App\ArtImages;
use App\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class FrontBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function redirectTo($slug)
    {
        $blog = Articles::where('slug', '=', $slug)->first();
        if ($blog) {
            return $this->show($slug);
        }
        $category = Category::where('slug', '=', $slug)->first();
        if ($category) {
            return $this->category($slug);
        }
        return redirect()->back();
    }

    public function index()
    {
        $blogsrecent = Articles::where('is_published', '=', 1)->latest()->get();
        $blogsviewed = Articles::where('is_published', '=', 1)->orderBy('view', 'desc')->get();
        $categories = Category::all();
//		$view = $blogs->view;
//		dd($view);
//        dd($blogsrecent);
        return view('frontend.blog.index', compact('blogsrecent', 'blogsviewed', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|Response|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();
        return view('frontend.blog.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $input = $request->all();

        if (!isset($input['categories'])) {
            $notification = array(
                'message' => 'Please select your blog category.',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }

        $this->validate(request(), [
            'title' => 'required',
            'cover_image' => 'required | image',
            'description' => 'required'
        ]);

        //Uploading one cover image

        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $name = time() . rand(0, 999) . '.'
                . $request->cover_image->getClientOriginalExtension();
            $destinationPath = public_path('/images/blogs');

            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            Image::make($request->file('cover_image'))->resize(1350, 660)->save(public_path('/images/blogs/thumbnail/' . $name));
            $success = $request->cover_image->move($destinationPath, $name);


            if (!$success) {
                $notification = array(
                    'message' => 'Sorry there was as error uploading cover image. Please try again.',
                    'alert-type' => 'error',
                );

                return redirect()->back()->with($notification);
            }
        }

        //Creating a article

        $article = new Articles();
        $article->user_id = Auth::user()->id;
        $article->title = $input['title'];
        $article->article = $input['description'];
        $article->author = Auth::user()->name;
        $article->cover_image = $name;
        $article->slug = str_slug($input['title'], '-');
        $article->view = rand(40, 50);
        $article->save();

        foreach ($input['categories'] as $category) {
            $article->categories()->attach($category);
        }


        //Uploading other images
        if (isset($input['other_images']) && count($input['other_images']) > 0) {
            foreach ($input['other_images'] as $other) {
                $ext = $other->getClientOriginalExtension();
                $filename = 'file-' . rand(0, 999) . '.' . $ext;
                $destinationPath = public_path('/images/blogs/images');

                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $success = $other->move($destinationPath, $filename);

                if ($success) {
                    $nextImage = new ArtImages();
                    $nextImage->article_id = $article->id;
                    $nextImage->image = $filename;
                    $nextImage->save();
                }
            }
        }


        $notification = array(
            'message' => 'Blog Added Successfully. Your blog will be reviewed and published shortly.',
            'alert-type' => 'success',
        );

        return redirect('/profile/username')->with('notification', $notification);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|Response|\Illuminate\View\View
     */
    public function show($slug)
    {
        $blogs = Articles::all();
        $blog = Articles::where('slug', '=', $slug)->first();
        if (!$blog) {
            return view('frontend/blog/index', compact('blogs'))
                ->with('error', 'The blog you are looking for is either deleted or does not exist.');
        }

        $blog->view += 1;
        $blog->save();

        $seo = $blog->seoblog;
        $categories = Category::all();
        return view('frontend/blog/blogContent', compact('blog', 'categories', 'seo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        $blog = Articles::find($id);

        if ($blog == null) {
            $notification = array(
                'message' => 'The blog you are trying to edit is either deleted or does not exist.',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }

        $categories = Category::all();

        return view('frontend.blog.create', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $blog = Articles::find($id);

        if ($blog == null) {
            $notification = array(
                'message' => 'The blog you are trying to edit is either deleted or does not exist.',
                'alert-type' => 'error',
            );

            return redirect('/profile/name')->with('notification', $notification);
        }

        $this->validate(request(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        $input = $request->all();

        if (!isset($input['categories'])) {
            $notification = array(
                'message' => 'Please select your blog category.',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }

        //Detaching or removing old associated categories and adding new from input because
        // comparing and removing each of them is pain in the ass
        foreach ($blog->categories as $category) {
            $blog->categories()->detach($category);
        }

        foreach ($input['categories'] as $category) {
            $blog->categories()->attach($category);
        }

        $blog->title = $input['title'];
        $blog->article = $input['description'];


        //If new cover image is uploaded remove old one and resize and save new one along with the old resized.
        if ($request->hasFile('cover_image')) {

            if ($request->file('cover_image')->isValid()) {

                if ($blog->cover_image != null) {

                    if (file_exists(public_path('/images/blogs/' . $blog->cover_image))) {
                        unlink(public_path('/images/blogs/' . $blog->cover_image));
                    }

                    if (file_exists(public_path('/images/blogs/thumbnail/' . $blog->cover_image))) {
                        unlink(public_path('/images/blogs/thumbnail/' . $blog->cover_image));
                    }
                }

                $ext = $request->cover_image->extension();
                $filename = 'file-' . rand(0, 999) . '.' . $ext;
                $destinationPath = public_path('/images/blogs');

                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                Image::make($request->file('cover_image'))->resize(1350, 660)->save(public_path('/images/blogs/thumbnail/' . $filename));
                $success = $request->cover_image->move($destinationPath, $filename);

                $blog->cover_image = $filename;
            }
        }

        //If input has other images uploaded upload new images deleting is done via ajax call.
        if (isset($input['other_images']) && (count($input['other_images']) > 0)) {

            foreach ($input['other_images'] as $image) {
                $ext = $image->extension();
                $filename = 'file-' . rand(0, 999) . '.' . $ext;
                $destinationPath = public_path('/images/blogs/images');

                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $success = $image->move($destinationPath, $filename);

                if ($success) {
                    $nextImage = new ArtImages();
                    $nextImage->article_id = $blog->id;
                    $nextImage->image = $filename;
                    $nextImage->save();
                }

            }
        }

        $blog->save();

        return redirect('/profile/username')->with('success', 'Your changes will be reviewed and updated soon.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|Response|\Symfony\Component\HttpFoundation\Response
     * @throws Exception
     */
    public function deleteOtherImage(Request $request, $id)
    {
        $image = ArtImages::find($id);

        if ($image != null) {
            $name = $image->image;
            $image->delete();

            if (file_exists(url('/images/blogs/images/' . $name))) {
                unlink(url('/images/blogs/images/' . $name));
            }

            $data = 1;

            return response(data);
        }
    }

    public function category($slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->first();
        $blogsrecent = $category->recentArticles;
        $blogsviewed = $category->moreviewedArticles;
        $cat_id = $category->id;
        return view('frontend.blog.index', compact('categories', 'cat_id', 'blogsrecent', 'blogsviewed'));
    }
}
