<?php

namespace App\Http\Controllers;

use App\Tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function create(){
        return view('frontend.articles.tags.create');
    }
    public function store(Request $request){
        Tags::create($request->all());
        flash()->overlay('Tag Sucessfully added','Thank You');
        return redirect('/blog/write');
    }
}
