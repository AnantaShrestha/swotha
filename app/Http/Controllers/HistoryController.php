<?php

namespace App\Http\Controllers;


use App\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class HistoryController extends Controller
{
    public function history(){
        $history = About::where('ref','=','history')->first();
        return view('admin-panel.about.company.history.history',compact('history'));
    }
    public function historycreate(){
        return view('admin-panel.about.company.history.historycreate');
    }
    public function historystore(Request $request){
        $input =  $request->all();
        $image = $input['cover_image'];
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['cover_image'] = $filename;
        Image::make(Request::capture()->file('cover_image'))->save( public_path('/images/about/' . $filename ) );
        Image::make($image)->resize(1920,920)->save( public_path('/images/about/cover/' . $filename ) );
        Image::make($image)->resize(425,245)->save( public_path('/images/about/thumbnail/' . $filename ) );
        About::create($input);
        return redirect('/backend/about/history');
    }
    public function historyedit(Request $request){
        $input =  $request->all();
        $history = About::find($input['id']);
        return view('admin-panel.about.company.history.historyedit',compact('history'));
    }
    public function historyupdate(Request $request){
        $input =  $request->all();
        $history = About::find($input['id']);
        $history->update($input);
        return redirect('/backend/about/history');
    }
    public function historycoveredit(Request $request){
        $input =  $request->all();
        $id = $input['id'];
//        $why = About::find($input['id']);
        return view('admin-panel.about.company.history.historycoveredit',compact('id'));
    }
    public function historycoverupdate(Request $request){
        $input = $request->all();
        $image = $input['cover_image'];
        $id = $input['id'];
        $cities = About::findorFail($id);
        File::delete(public_path('images/about/cover/'.$cities->cover_image));
        File::delete(public_path('images/about/thumbnail/'.$cities->cover_image));
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['cover_image'] = $filename;
//        Image::make(Request::capture()->file('cover_image'))->save( public_path('/images/cities/' . $filename ) );
        Image::make($image)->resize(1920,920)->save( public_path('/images/about/cover/' . $filename ) );
        Image::make($image)->resize(435,245)->save( public_path('/images/about/thumbnail/' . $filename ) );
        $cities->cover_image = $input['cover_image'];
        $cities->save();
        return redirect('/backend/about/history');
    }
}
