<?php

namespace App\Http\Controllers;

use App\Departments;
use App\MemDocs;
use App\TeamMembers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class TeamController extends Controller
{

    public function __construct()
    {
        $this->middleware('optimizeImages');
    }

    public function index(){
       $departments = Departments::orderBy('updated_at','DESC')->get();
       $members = TeamMembers::all();
       return view('admin-panel.about1.team.team',compact('departments', 'members'));
    }
    public function teamcreate(){
        $departments = Departments::all();
        return view('admin-panel.about1.team.teamcreate', compact('departments'));
    }
    public function teamstore(Request $request){
        $input = $request->all();
        $image = $input['photo'];
        $filename = 'team'.time() . '.' . $image->getClientOriginalExtension();
        $input['photo'] = $filename;
        $department = $input['department'];

        Image::make(Request::capture()->file('photo'))->save( public_path('/images/teampics/' . $filename ) );
        Image::make($image)->resize(300,300)->save( public_path('/images/teampics/thumbnail/' . $filename ) );
        $members = TeamMembers::create($input);

        if($department) {
            $members->departments()->attach($department);
        }
        return redirect('/backend/team');
    }
    public function edit($id){
        $member = TeamMembers::findorFail($id);
        $departments = Departments::all();
        return view('admin-panel.about1.team.teamedit', compact('member','departments'));
    }
    public function update(Request $request, $id){
        $input = $request->all();
	    $member = TeamMembers::findOrFail($id);
        $department = $input['department'];

        if($request->hasFile('photo')){
	        File::delete(public_path('images/teampics/'.$member->photo));
	        File::delete(public_path('images/blogs/thumbnail/'.$member->photo));
	        $image = $input['photo'];
	        $filename = time() . '.' . $image->getClientOriginalExtension();
	        $input['photo'] = $filename;
	        Image::make(Request::capture()->file('photo'))->save( public_path('/images/teampics/' . $filename ) );
	        Image::make($image)->resize(400,400)->save( public_path('/images/teampics/thumbnail/' . $filename ) );
        }else{
	        $input['cover_image'] = $member->photo;
        }
        $member->update($input);
        $member->departments()->sync($department);
        return redirect('/backend/team');
    }
    public function destroy($id){
        $member = TeamMembers::findOrFail($id);

        File::delete(public_path('images/teampics/'.$member->photo));
        File::delete(public_path('images/teampics/thumbnail/'.$member->photo));
        $member->delete();

        $member->departments()->detach();
        return redirect()->back();
    }
    public function show($id){
        $member = TeamMembers::findOrFail($id);
        return view('admin-panel.about1.team.teamshow', compact('member'));

    }

    //adding docs
    public function muldocs($id){
        $member = TeamMembers::findOrFail($id);
        return view('admin-panel.about1.team.docs.addmuldocs', compact('member'));
    }

    public function storemuldocs(Request $request){
        $input = $request->all();

        if ($request->hasFile('image')) {
            $files = $request->file('image');
            foreach($files as $file){
                $input['member_id'] =  $request->get('member_id');
                $input['image'] = null;
                $random_name = str_random(5);
                $destinationPath = public_path('/images/teampics/docs/');
                $extension = $file->getClientOriginalExtension();
                $input['image'] = $filename = $random_name.'_doc.'.$extension;
                $file->move($destinationPath, $filename);
                MemDocs::create($input);
            }
        }
        return $this->show($request->get('member_id'));
    }

    public function destroyimage($id){
        $image = MemDocs::findOrFail($id);
        File::delete(public_path('images/teampics/docs/'.$image->image));
        $image->delete();
        return redirect()->back();
    }
}
