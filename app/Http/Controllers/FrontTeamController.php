<?php

namespace App\Http\Controllers;

use App\About;
use App\Departments;
use App\TeamMembers;

class FrontTeamController extends Controller
{
    public function index($slug){
        $team = About::where('slug','=',$slug)->first();
        $departments = Departments::orderBy('updated_at','DESC')->get();
        return view('frontend.about.teammembers', compact('team','departments'));
    }

    public function show($id){
        $member = TeamMembers::findOrFail($id);
        $doc = $member->docs->first();
        return view('frontend.about.teammember', compact('member','doc'));
    }
}
