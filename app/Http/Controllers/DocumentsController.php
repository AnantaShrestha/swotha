<?php

namespace App\Http\Controllers;

use App\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class DocumentsController extends Controller
{
    public function documents(){
        $documents = About::where('ref','=','documents')->first();
        return view('admin-panel.about.company.documents.documents',compact('documents'));
    }
    public function create(){
        return view('admin-panel.about.company.documents.documentscreate');
    }
    public function documentsstore(Request $request){
        $input =  $request->all();
        $image = $input['cover_image'];
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['cover_image'] = $filename;
        Image::make(Request::capture()->file('cover_image'))->save( public_path('/images/about/' . $filename ) );
        Image::make($image)->resize(1920,810)->save( public_path('/images/about/cover/' . $filename ) );
        Image::make($image)->resize(425,245)->save( public_path('/images/about/thumbnail/' . $filename ) );
        About::create($input);
        return redirect('/backend/about/documents');
    }
    public function documentsedit(Request $request){
        $input =  $request->all();
        $documents = About::find($input['id']);
        return view('admin-panel.about.company.documents.documentsedit',compact('documents'));
    }
    public function documentsupdate(Request $request){
        $input =  $request->all();
        $documents = About::find($input['id']);
        $documents->update($input);
        return redirect('/backend/about/documents');
    }
    public function documentscoveredit(Request $request){
        $input =  $request->all();
        $id = $input['id'];
//        $why = About::find($input['id']);
        return view('admin-panel.about.company.documents.documentscoveredit',compact('id'));
    }
    public function documentscoverupdate(Request $request){
        $input = $request->all();
        $image = $input['cover_image'];
        $id = $input['id'];
        $cities = About::findorFail($id);
        File::delete(public_path('images/about/cover/'.$cities->cover_image));
        File::delete(public_path('images/about/thumbnail/'.$cities->cover_image));
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['cover_image'] = $filename;
//        Image::make(Request::capture()->file('cover_image'))->save( public_path('/images/cities/' . $filename ) );
        Image::make($image)->resize(1920,810)->save( public_path('/images/about/cover/' . $filename ) );
        Image::make($image)->resize(435,245)->save( public_path('/images/about/thumbnail/' . $filename ) );
        $cities->cover_image = $input['cover_image'];
        $cities->save();
        return redirect('/backend/about/documents');
    }
}
