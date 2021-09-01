<?php

namespace App\Http\Controllers;

use App\About;
use App\AboutDetails;

class FrontendAboutController extends Controller
{
    public function show($slug){
        $about = About::where('slug','=',$slug)->first();
        $sections = $about->details;
        return view('frontend.about.show',compact('about','sections'));
    }
    
    public function showcontent($id){
    	$contents = AboutDetails::findOrFail($id);
//    	dd($contents);
    	return view('frontend.about.showcontent',compact('contents'));
    }
}
