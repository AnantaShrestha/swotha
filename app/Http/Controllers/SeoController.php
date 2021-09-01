<?php

namespace App\Http\Controllers;

use App\Articles;
use App\SeoBlog;
use App\Seotrip;
use App\Trips;
use Illuminate\Http\Request;

class SeoController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request)
	{
		$input = $request->all();
		$seoData = Seotrip::where('trip_id', $input['trip_id'])->first();
		$tripId = $input['trip_id'];
		return view('admin-panel.Trips.seo', compact('seoData', 'tripId'));
	}
	
	public function createblog(Request $request)
	{
		$input = $request->all();
		$seoData = SeoBlog::where('blog_id', $input['blog_id'])->first();
		$blogId = $input['blog_id'];
		return view('admin-panel.blog.seo', compact('seoData', 'blogId'));
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$input = $request->all();
		$seo = Seotrip::where('trip_id', $input['trip_id'])->first();
		
		$name = Trips::select('name')->where('id', $input['trip_id'])->first();
		$name = $name->name;
		
		$act = 'updat';
		
		if(is_null($seo)){
			$seo = new Seotrip();
			$seo->trip_id = $input['trip_id'];
			$act = 'add';
		}
		
		$seo->keywords = $input['keywords'];
		$seo->meta_title = $input['metaTitle'];
		$seo->meta_description = $input['metaDescription'];
		$seo->save();
		
		// return redirect('/backend/unblog')->with('success', 'SEO of ' . $name . ' ' . $act . 'ed successfully');

		   $notification = array(
			   'message' => 'SEO of ' . $name . ' ' . $act . 'ed successfully',
			   'alert-type' => 'error',
		   );

		return redirect('/backend/trips/'.$input['trip_id']);
		
	}
	
	public function storeblog(Request $request)
	{
		$input = $request->all();
		$seo = SeoBlog::where('blog_id', $input['blog_id'])->first();
		
		$name = Articles::select('title')->where('id', $input['blog_id'])->first();
		$name = $name->title;
		
		$act = 'updat';
		
		if (is_null($seo)) {
			$seo = new SeoBlog();
			$seo->blog_id = $input['blog_id'];
			$act = 'add';
		}
		
		$seo->keywords = $input['keywords'];
		$seo->meta_title = $input['metaTitle'];
		$seo->meta_description = $input['metaDescription'];
		$seo->save();
		
		return redirect('/backend/blog/' . $input['blog_id'] . '/show')->with('success', 'SEO of ' . $name . ' ' . $act . 'ed successfully');
		
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
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
	public function destroy($id)
	{
		//
	}
}
