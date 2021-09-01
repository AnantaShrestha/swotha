<?php

namespace App\Http\Controllers;


class AboutController extends Controller
{
    public function index()
    {
        return view('admin-panel.about1.index');
    }
//    public function company(){
//        return view('admin-panel.about.company.index');
//    }
//    public function why(){
//        $why = About::where('ref','=','why')->first();
//        return view('admin-panel.about.company.whyswotah.why',compact('why'));
//    }
//    public function whycreate(){
//        return view('admin-panel.about.company.whyswotah.whycreate');
//    }
//    public function whystore(Request $request){
//        $input =  $request->all();
//        $image = $input['cover_image'];
//        $filename = time() . '.' . $image->getClientOriginalExtension();
//        $input['cover_image'] = $filename;
//        Image::make(Request::capture()->file('cover_image'))->save( public_path('/images/about/' . $filename ) );
//        Image::make($image)->resize(1920,920)->save( public_path('/images/about/cover/' . $filename ));
//        Image::make($image)->resize(435, 245)->save( public_path('/images/about/thumbnail/' . $filename ) );
//        About::create($input);
//        return redirect('/backend/about/why');
//    }
//    public function whyedit(Request $request){
//        $input =  $request->all();
//        $why = About::find($input['id']);
//        return view('admin-panel.about.company.whyswotah.whyedit',compact('why'));
//    }
//    public function whyupdate(Request $request){
//        $input =  $request->all();
//        $why = About::find($input['id']);
//        $why->update($input);
//        return redirect('/backend/about/why');
//    }
//    public function whycoveredit(Request $request){
//        $input =  $request->all();
//        $id = $input['id'];
////        $why = About::find($input['id']);
//        return view('admin-panel.about.company.whyswotah.whycoveredit',compact('id'));
//    }
//    public function whycoverupdate(Request $request){
//        $input = $request->all();
//        $image = $input['cover_image'];
//        $id = $input['id'];
//        $cities = About::findorFail($id);
//        File::delete(public_path('images/about/cover'.$cities->cover_image));
//        File::delete(public_path('images/about/thumbnail/'.$cities->image));
//        $filename = time() . '.' . $image->getClientOriginalExtension();
//        $input['cover_image'] = $filename;
////        Image::make(Request::capture()->file('cover_image'))->save( public_path('/images/cities/' . $filename ) );
//        Image::make($image)->resize(1920,920)->save( public_path('/images/about/cover/' . $filename ) );
//        Image::make($image)->resize(435,245)->save( public_path('/images/about/thumbnail/' . $filename ) );
//        $cities->cover_image = $input['cover_image'];
//        $cities->save();
//        return redirect('/backend/about/why');
//    }


}
