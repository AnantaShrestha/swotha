<?php

namespace App\Http\Controllers;

use App\Helper\PasswordChecker;
use App\TrekkingPartners;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allPosts = TrekkingPartners::latest()->get();
        return view('admin-panel.trekkingPartners.index', compact('allPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$post = TrekkingPartners::where('id', $id)->first();
    	
    	if(is_null($post)){
    		return redirect()->back()->with('error', 'The post you are trying to view doesn\'t exist');
	    }
	    
	    return view('admin-panel.trekkingPartners.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
	    $input = $request->all();
	    $result = PasswordChecker::checkpass($input['password']);
	
	    if($result == true){
		    $post = TrekkingPartners::findOrFail($id);
//		    dd($post);
		    $post->delete();
		    return redirect()->back()->with('success', 'Post Deleted Successfully.');
	    } else {
		    return redirect()->back()->with('error', 'The Password You Entered is incorrect.');
	    }
    }
}
