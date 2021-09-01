<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class GalleryColtroller extends Controller
{
    public function create(Request $request){
        $input = $request->all();
        $trip_id = $input['trip_id'];
        return view('admin-panel.Gallery.createPhotos',compact('trip_id'));
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $image = $input['image'];
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['image'] = $filename;
        Image::make(Request::capture()->file('image'))->resize(1080,720)->save( public_path('/images/gallery/' . $filename ) );
        Gallery::create($input);
        return redirect('/backend/trips/'.$input['trip_id']);
      
    }
    public function addMap(Request $request){
        $input = $request->all();
        $trip_id = $input['trip_id'];
        return view('admin-panel.Gallery.createmap',compact('trip_id'));

    }

    public function  uploadmap(Request $request){
        $input = $request->all();
        $image = $input['image'];
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['image'] = $filename;
        Image::make(Request::capture()->file('image'))->resize(1350,660)->save( public_path('/images/gallery/' . $filename ) );
        Gallery::create($input);
        return redirect('/backend/trips/'.$input['trip_id']);
    }
    public function show($id){
        $photos = Gallery::where('trip_id','=',$id)->paginate(6);
        return view('admin-panel.Gallery.show',compact('photos'));
    }
    public function destroy($id){
        $photo = Gallery::findOrFail($id);
        $photo->delete();
        return redirect()->back();
    }

    public function edit($id){
        $photo = Gallery::where('id','=', $id)->first();
        return view('admin-panel.Gallery.edit',compact('photo'));
    }

    public function update(Request $request, $id){
        $input = $request->all();

        $photo = Gallery::findOrFail($id);

        $image = $input['image'];
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['image'] = $filename;
        Image::make(Request::capture()->file('image'))->resize(1080,720)->save( public_path('/images/gallery/' . $filename ) );
        
        $photo->image = $input['image'];
        $photo->save();

        return redirect('/backend/gallery/show/'.$input['trip_id']);
    }
}
